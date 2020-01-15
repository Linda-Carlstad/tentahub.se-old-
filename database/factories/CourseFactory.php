<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'association_id' => $faker->numberbetween(1,5),
        'code' => $faker->regexify('[A-Za-z0-9]{10}'),
        'points' => $faker->numberbetween(1,30),
        'url' => $faker->url,
        'description' => $faker->text
    ];
});
