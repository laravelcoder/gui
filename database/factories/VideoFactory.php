<?php

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "extention" => $faker->name,
        "clip_id" => factory('App\Clip')->create(),
        "ad_duration" => $faker->name,
    ];
});
