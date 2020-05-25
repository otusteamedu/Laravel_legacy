<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Schedule;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Schedule::class, function (Faker $faker, $params) {

    $data = [
        'style_id' => 1,
        'instructor_id' => 1,
        'days' => $faker->dayOfWeek,
        'time' => $faker->dateTime,

    ];

    return $data;


});
