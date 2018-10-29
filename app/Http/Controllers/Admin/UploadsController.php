<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
   

 

	public function uploadSubmit(Request $request)
	{
	    $photos = [];
	    foreach ($request->photos as $photo) {
	        $filename = $photo->store('photos');
	        $product_photo = ProductPhoto::create([
	            'filename' => $filename
	        ]);

	        $photo_object = new \stdClass();
	        $photo_object->name = str_replace('photos/', '',$photo->getClientOriginalName());
	        $photo_object->size = round(Storage::size($filename) / 1024, 2);
	        $photo_object->fileID = $product_photo->id;
	        $photos[] = $photo_object;
	    }

	    return response()->json(array('files' => $photos), 200);

	}

	public function postProduct(Request $request)
	{
	    $product = Product::create($request->all());
	    ProductPhoto::whereIn('id', explode(",", $request->file_ids))
	        ->update(['product_id' => $product->id]);
	    return 'Product saved successfully';
	}
}
