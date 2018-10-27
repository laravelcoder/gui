<?php

namespace App\Http\Controllers\Admin;

use App\Clip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClipsRequest;
use App\Http\Requests\Admin\UpdateClipsRequest;
use Yajra\DataTables\DataTables;

class ClipsController extends Controller
{
    /**
     * Display a listing of Clip.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('clip_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = Clip::query();
            $query->with("brand");
            $query->with("industry");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('clip_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'clips.id',
                'clips.ad_enabled',
                'clips.total_impressions',
                'clips.recommended_frequency',
                'clips.ad_airing_date_first',
                'clips.ad_airing_date_last',
                'clips.brand_id',
                'clips.industry_id',
                'clips.advertiser',
                'clips.product',
                'clips.title',
                'clips.description',
                'clips.notes',
                'clips.agency',
                'clips.sourceurl',
                'clips.imagespath',
                'clips.cai_path',
                'clips.caipyurl',
                'clips.isci_ad_id',
                'clips.copylength',
                'clips.media_content',
                'clips.media_filename',
                'clips.scheduledate',
                'clips.expirationdate',
                'clips.family',
                'clips.subfamily',
                'clips.group',
                'clips.caipy_clipids',
                'clips.reviewstate',
                'clips.ignoreimport',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'clip_';
                $routeKey = 'admin.clips';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('ad_enabled', function ($row) {
                return \Form::checkbox("ad_enabled", 1, $row->ad_enabled == 1, ["disabled"]);
            });
            $table->editColumn('total_impressions', function ($row) {
                return $row->total_impressions ? $row->total_impressions : '';
            });
            $table->editColumn('recommended_frequency', function ($row) {
                return $row->recommended_frequency ? $row->recommended_frequency : '';
            });
            $table->editColumn('ad_airing_date_first', function ($row) {
                return $row->ad_airing_date_first ? $row->ad_airing_date_first : '';
            });
            $table->editColumn('ad_airing_date_last', function ($row) {
                return $row->ad_airing_date_last ? $row->ad_airing_date_last : '';
            });
            $table->editColumn('brand.name', function ($row) {
                return $row->brand ? $row->brand->name : '';
            });
            $table->editColumn('industry.name', function ($row) {
                return $row->industry ? $row->industry->name : '';
            });
            $table->editColumn('advertiser', function ($row) {
                return $row->advertiser ? $row->advertiser : '';
            });
            $table->editColumn('product', function ($row) {
                return $row->product ? $row->product : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('agency', function ($row) {
                return $row->agency ? $row->agency : '';
            });
            $table->editColumn('sourceurl', function ($row) {
                return $row->sourceurl ? $row->sourceurl : '';
            });
            $table->editColumn('imagespath', function ($row) {
                return $row->imagespath ? $row->imagespath : '';
            });
            $table->editColumn('cai_path', function ($row) {
                return $row->cai_path ? $row->cai_path : '';
            });
            $table->editColumn('caipyurl', function ($row) {
                return $row->caipyurl ? $row->caipyurl : '';
            });
            $table->editColumn('isci_ad_id', function ($row) {
                return $row->isci_ad_id ? $row->isci_ad_id : '';
            });
            $table->editColumn('copylength', function ($row) {
                return $row->copylength ? $row->copylength : '';
            });
            $table->editColumn('media_content', function ($row) {
                return $row->media_content ? $row->media_content : '';
            });
            $table->editColumn('media_filename', function ($row) {
                return $row->media_filename ? $row->media_filename : '';
            });
            $table->editColumn('scheduledate', function ($row) {
                return $row->scheduledate ? $row->scheduledate : '';
            });
            $table->editColumn('expirationdate', function ($row) {
                return $row->expirationdate ? $row->expirationdate : '';
            });
            $table->editColumn('family', function ($row) {
                return $row->family ? $row->family : '';
            });
            $table->editColumn('subfamily', function ($row) {
                return $row->subfamily ? $row->subfamily : '';
            });
            $table->editColumn('group', function ($row) {
                return $row->group ? $row->group : '';
            });
            $table->editColumn('caipy_clipids', function ($row) {
                return $row->caipy_clipids ? $row->caipy_clipids : '';
            });
            $table->editColumn('reviewstate', function ($row) {
                return $row->reviewstate ? $row->reviewstate : '';
            });
            $table->editColumn('ignoreimport', function ($row) {
                return \Form::checkbox("ignoreimport", 1, $row->ignoreimport == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','ad_enabled','ignoreimport']);

            return $table->make(true);
        }

        return view('admin.clips.index');
    }

    /**
     * Show the form for creating new Clip.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('clip_create')) {
            return abort(401);
        }
        
        $brands = \App\Brand::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $industries = \App\Industry::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.clips.create', compact('brands', 'industries'));
    }

    /**
     * Store a newly created Clip in storage.
     *
     * @param  \App\Http\Requests\StoreClipsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClipsRequest $request)
    {
        if (! Gate::allows('clip_create')) {
            return abort(401);
        }
        $clip = Clip::create($request->all());

        foreach ($request->input('videos', []) as $data) {
            $clip->videos()->create($data);
        }
        foreach ($request->input('brands', []) as $data) {
            $clip->brands()->create($data);
        }


        return redirect()->route('admin.clips.index');
    }


    /**
     * Show the form for editing Clip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('clip_edit')) {
            return abort(401);
        }
        
        $brands = \App\Brand::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $industries = \App\Industry::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $clip = Clip::findOrFail($id);

        return view('admin.clips.edit', compact('clip', 'brands', 'industries'));
    }

    /**
     * Update Clip in storage.
     *
     * @param  \App\Http\Requests\UpdateClipsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClipsRequest $request, $id)
    {
        if (! Gate::allows('clip_edit')) {
            return abort(401);
        }
        $clip = Clip::findOrFail($id);
        $clip->update($request->all());

        $videos           = $clip->videos;
        $currentVideoData = [];
        foreach ($request->input('videos', []) as $index => $data) {
            if (is_integer($index)) {
                $clip->videos()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentVideoData[$id] = $data;
            }
        }
        foreach ($videos as $item) {
            if (isset($currentVideoData[$item->id])) {
                $item->update($currentVideoData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $brands           = $clip->brands;
        $currentBrandData = [];
        foreach ($request->input('brands', []) as $index => $data) {
            if (is_integer($index)) {
                $clip->brands()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentBrandData[$id] = $data;
            }
        }
        foreach ($brands as $item) {
            if (isset($currentBrandData[$item->id])) {
                $item->update($currentBrandData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.clips.index');
    }


    /**
     * Display Clip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('clip_view')) {
            return abort(401);
        }
        
        $brands = \App\Brand::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $industries = \App\Industry::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$videos = \App\Video::where('clip_id', $id)->get();$brands = \App\Brand::where('clip_id', $id)->get();

        $clip = Clip::findOrFail($id);

        return view('admin.clips.show', compact('clip', 'videos', 'brands'));
    }


    /**
     * Remove Clip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clip_delete')) {
            return abort(401);
        }
        $clip = Clip::findOrFail($id);
        $clip->delete();

        return redirect()->route('admin.clips.index');
    }

    /**
     * Delete all selected Clip at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('clip_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Clip::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Clip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('clip_delete')) {
            return abort(401);
        }
        $clip = Clip::onlyTrashed()->findOrFail($id);
        $clip->restore();

        return redirect()->route('admin.clips.index');
    }

    /**
     * Permanently delete Clip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('clip_delete')) {
            return abort(401);
        }
        $clip = Clip::onlyTrashed()->findOrFail($id);
        $clip->forceDelete();

        return redirect()->route('admin.clips.index');
    }
}
