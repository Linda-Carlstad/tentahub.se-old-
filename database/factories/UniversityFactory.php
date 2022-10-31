<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use App\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'nickname' => $faker->userName,
        'city' => $faker->city,
        'country' => $faker->country,
        'description' => "Test",
        'url' => "192.0.0.1",
    ];
});
