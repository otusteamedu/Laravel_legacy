<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Workout;
use Faker\Generator as Faker;

$factory->define(Workout::class, function (Faker $faker) {
    return [
        "time" => $faker->randomNumber(4),
        "private" => $faker->numberBetween(0, 1),
        "user_id" => factory(App\Models\User::class),
        "complex_id" => factory(App\Models\Complex::class)
    ];
});
