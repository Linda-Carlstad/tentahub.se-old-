<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\University;
use Faker\Generator as Faker;

$factory->define(University::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'nickname' => $faker->userName,
        'city' => $faker->city
    ];
});
