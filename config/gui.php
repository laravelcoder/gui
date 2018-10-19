<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        //resource_path('views'),
        'clip_path' => env('CLIP_PATH', public_path('uploads/clips')),
        'upload_path' => env('UPLOAD_PATH', public_path('uploads')),
        'cai_server' => env('CAI_SERVER', 'http://d-gp2-tocai-1.imovetv.com'),
        'image_path' => env('IMAGE_PATH', public_path('uploads/images')),
        'thumb_path' => env('THUMB_PATH', public_path('uploads/thumbs')),
        'cai_Path' =>  env('CAI_PATH', public_path('uploads/cai')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    


];
