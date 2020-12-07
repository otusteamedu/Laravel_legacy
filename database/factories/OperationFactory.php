<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(App\Models\Operation::class, function (Faker $faker) {
    return [
        'sum' => $faker->randomFloat(2, 50, 5000),
        'category_id' => $faker->numberBetween(7, 17),
        'description' => $faker->text(50),
        'user_id' => '1',
        'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = 'UTC'),
    ];
});


