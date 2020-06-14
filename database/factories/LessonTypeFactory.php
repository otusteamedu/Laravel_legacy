<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LessonType;
use Faker\Generator as Faker;

$factory->define(LessonType::class, function (Faker $faker) {
    return [
        'type' => $faker->unique()->word,
    ];
});
