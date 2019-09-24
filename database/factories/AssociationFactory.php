<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Association;
use Faker\Generator as Faker;

$factory->define(Association::class, function (Faker $faker) {
    return [
        'university_id' => $faker->numberBetween(0,100),
        'nickname' => $faker->word,
        'name' => $faker->company
    ];
});
