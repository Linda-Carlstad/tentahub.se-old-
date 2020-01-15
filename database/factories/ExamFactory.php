<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use Faker\Generator as Faker;

$factory->define(Exam::class, function (Faker $faker) {
    return [
        'course_id' => $faker->numberBetween(0,5),
        'file_name' => $faker->userName . '.pdf',
        'name' => $faker->userName,
        'views' => $faker->randomDigit,
        'rating'=> $faker->numberBetween(0,10),
        'grade' => $faker->century,
    ];
});
