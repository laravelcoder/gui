<?php

$factory->define(App\Industry::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "slug" => $faker->name,
    ];
});
