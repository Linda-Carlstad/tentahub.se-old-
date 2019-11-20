<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Association;
use Faker\Generator as Faker;

$factory->define(Association::class, function (Faker $faker) {
    return [
        'university_id' => $faker->numberBetween(1,100),
        'url' => $faker->url,
        'name' => $faker->company,
        'description' => $faker->text
    ];
});
