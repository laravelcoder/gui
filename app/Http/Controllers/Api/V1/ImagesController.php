<?php

namespace App\Http\Controllers\Api\V1;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagesRequest;
use App\Http\Requests\Admin\UpdateImagesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class ImagesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Image::all();
    }

    public function show($id)
    {
        return Image::findOrFail($id);
    }

    public function update(UpdateImagesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $image = Image::findOrFail($id);
        $image->update($request->all());
        

        return $image;
    }

    public function store(StoreImagesRequest $request)
    {
        $request = $this->saveFiles($request);
        $image = Image::create($request->all());
        

        return $image;
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return '';
    }
}
