<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;



$factory->define(Student::class, function (Faker $faker) {

    $name = $faker->name();

    return [
        'name' => $name,
    ];
});
