<?php

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        "clip_id" => factory('App\Clip')->create(),
        "name" => $faker->name,
        "ad_duration" => $faker->name,
    ];
});
