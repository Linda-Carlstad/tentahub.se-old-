<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'association_id' => $faker->numberbetween(1,100),
        'code' => $faker->word . $faker->century
    ];
});
