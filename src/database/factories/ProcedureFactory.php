<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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

$factory->define(\App\Models\Procedure::class, function (Faker $faker) {
    return [
        'duration' => $faker->numberBetween(20, 120),
        'price' => $faker->randomFloat(2, 300, 1200),
        'people_count' => $faker->randomFloat(0, 1, 3),
    ];
});
