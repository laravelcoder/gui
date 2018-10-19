<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('clips', 'ClipsController', ['except' => ['create', 'edit']]);

        Route::resource('industries', 'IndustriesController', ['except' => ['create', 'edit']]);

        Route::resource('images', 'ImagesController', ['except' => ['create', 'edit']]);

        Route::resource('brands', 'BrandsController', ['except' => ['create', 'edit']]);

});
