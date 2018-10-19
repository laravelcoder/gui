<?php

namespace App\Http\Controllers\Api\V1;

use App\Clip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClipsRequest;
use App\Http\Requests\Admin\UpdateClipsRequest;
use Yajra\DataTables\DataTables;

class ClipsController extends Controller
{
    public function index()
    {
        return Clip::all();
    }

    public function show($id)
    {
        return Clip::findOrFail($id);
    }

    public function update(UpdateClipsRequest $request, $id)
    {
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

        return $clip;
    }

    public function store(StoreClipsRequest $request)
    {
        $clip = Clip::create($request->all());
        
        foreach ($request->input('videos', []) as $data) {
            $clip->videos()->create($data);
        }
        foreach ($request->input('brands', []) as $data) {
            $clip->brands()->create($data);
        }

        return $clip;
    }

    public function destroy($id)
    {
        $clip = Clip::findOrFail($id);
        $clip->delete();
        return '';
    }
}
