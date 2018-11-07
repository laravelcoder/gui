<?php

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        "clip_id" => factory('App\Clip')->create(),
    ];
});
