<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'id_number' => $faker->unique()->numberBetween(100000, 999999),
    ];
});
