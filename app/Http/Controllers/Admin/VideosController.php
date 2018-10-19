<?php

namespace App\Http\Controllers\Admin;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideosRequest;
use App\Http\Requests\Admin\UpdateVideosRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
 
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Media;


class VideosController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Video.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('video_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Video::query();
            $query->with("clip");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('video_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'videos.id',
                'videos.video',
                'videos.name',
                'videos.extention',
                'videos.clip_id',
                'videos.ad_duration',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'video_';
                $routeKey = 'admin.videos';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('video', function ($row) {
                if($row->video) { return '<a href="'.asset(env('UPLOAD_PATH').'/'.$row->video) .'" target="_blank">Download file</a>'; };
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('extention', function ($row) {
                return $row->extention ? $row->extention : '';
            });
            $table->editColumn('clip.title', function ($row) {
                return $row->clip ? $row->clip->title : '';
            });
            $table->editColumn('ad_duration', function ($row) {
                return $row->ad_duration ? $row->ad_duration : '';
            });

            $table->rawColumns(['actions','massDelete','video']);

            return $table->make(true);
        }

        return view('admin.videos.index');
    }

    /**
     * Show the form for creating new Video.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('video_create')) {
            return abort(401);
        }
        
        $clips = \App\Clip::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.videos.create', compact('clips'));
    }

    /**
     * Store a newly created Video in storage.
     *
     * @param  \App\Http\Requests\StoreVideosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideosRequest $request)
    {
        if (! Gate::allows('video_create')) {
            return abort(401);
        }
   
        $request = $this->saveFiles($request);
        $video = Video::create($request->all());
        foreach ($request->input('video_id', []) as $index => $id) {
            $model = config('medialibrary.media_model');
            $file = $model::find($id);
            $file->model_id = $video->id;
            $file->save();
        }


        return redirect()->route('admin.videos.index');
    }


    /**
     * Show the form for editing Video.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('video_edit')) {
            return abort(401);
        }
        
        $clips = \App\Clip::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $video = Video::findOrFail($id);

        return view('admin.videos.edit', compact('video', 'clips'));
    }

    /**
     * Update Video in storage.
     *
     * @param  \App\Http\Requests\UpdateVideosRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideosRequest $request, $id)
    {
        if (! Gate::allows('video_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $video = Video::findOrFail($id);
        $video->update($request->all());
        if ($request->video === true) {
            $media = [];
            foreach ($request->input('video_id[]') as $index => $id) {
                $model = config('laravel-medialibrary.media_model');
                $file = $model::find($id);
                $file->model_id = $video->id;
                $file->save();
                $media[] = $file->toArray();
            }
            $video->updateMedia($media, 'video');
        }
        return redirect()->route('admin.videos.index');
    }


    /**
     * Display Video.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('video_view')) {
            return abort(401);
        }
        $video = Video::findOrFail($id);

        return view('admin.videos.show', compact('video'));
    }


    /**
     * Remove Video from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('video_delete')) {
            return abort(401);
        }
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.videos.index');
    }

    /**
     * Delete all selected Video at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('video_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Video::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Video from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('video_delete')) {
            return abort(401);
        }
        $video = Video::onlyTrashed()->findOrFail($id);
        $video->restore();

        return redirect()->route('admin.videos.index');
    }

    /**
     * Permanently delete Video from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('video_delete')) {
            return abort(401);
        }
        $video = Video::onlyTrashed()->findOrFail($id);
        $video->forceDelete();

        return redirect()->route('admin.videos.index');
    }
}
