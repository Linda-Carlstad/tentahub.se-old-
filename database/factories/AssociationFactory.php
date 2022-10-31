<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Association;
use Faker\Generator as Faker;

$factory->define(Association::class, function (Faker $faker) {
    return [
        'university_id' => $faker->numberBetween(1,5),
        'url' => "192.0.0.1",
        'name' => $faker->company,
        'description' => "Test",
        'public' => true,
    ];
});
