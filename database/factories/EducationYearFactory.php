<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EducationYear;
use Faker\Generator as Faker;

$factory->define(EducationYear::class, function (Faker $faker) {
    return [
        'start_at' => $faker->date('Y-m-d', '+ 1 year'),
        'end_at' => $faker->date('Y-m-d', '+ 2 year'),
    ];
});
