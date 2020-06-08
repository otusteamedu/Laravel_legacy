<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(\App\Models\Price::class, function (Faker $faker) {

    return [
        'price' => $faker->randomFloat(0, 300, 2000),
        'price_fix' => $faker->randomFloat(0, 0, 3000)
    ];
});
