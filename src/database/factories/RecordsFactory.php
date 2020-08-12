<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(\App\Models\Record::class, function (Faker $faker) {
    $date_start = $faker->dateTimeBetween('-1 month');
    $date_end = Carbon::createFromTimestamp(rand(200, 6200) + $date_start->getTimestamp());
    $user = \App\Models\User::inRandomOrder()->first();

    return [
        'date_start' => $date_start,
        'date_end' => $date_end,
        'status' => rand(0, 3),
        'user_create' => $user->id,
        'user_update' => $user->id,
    ];
});
