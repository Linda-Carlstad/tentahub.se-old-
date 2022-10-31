<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\Association;
use Faker\Generator as Faker;

$factory->define(Association::class, function (Faker $faker) {
    return [
        'university_id' => $faker->numberBetween(1,5),
        'url' => $faker->url,
        'name' => $faker->company,
        'description' => $faker->text,
        'public' => true,
    ];
});
