<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $number = $faker->numberbetween(1,1000000);
    return [
        'name' => $faker->company,
        'association_id' => $faker->numberbetween(1,5),
        'code' => "ISA10$number",
        'points' => $faker->numberbetween(1,30),
        'url' => "192.0.0.1",
        'description' => "Test"
    ];
});
