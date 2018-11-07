<?php

namespace App\Http\Controllers\Api\V1;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideosRequest;
use App\Http\Requests\Admin\UpdateVideosRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class VideosController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Video::all();
    }

    public function show($id)
    {
        return Video::findOrFail($id);
    }

    public function update(UpdateVideosRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $video = Video::findOrFail($id);
        $video->update($request->all());
        

        return $video;
    }

    public function store(StoreVideosRequest $request)
    {
        $request = $this->saveFiles($request);
        $video = Video::create($request->all());
        

        return $video;
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return '';
    }
}
