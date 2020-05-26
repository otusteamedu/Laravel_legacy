<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Finance::class, function (Faker $faker) {
    return [
        'user_id' => \App\Models\User::all()->random()->id,
        'operation' => rand(0,1),
        'sum' => $faker->randomFloat(2, 1, 100000)
    ];
});
