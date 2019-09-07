<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->streetAddress,
        'distance' => $faker->randomElement([
            5000,
            10000,
            21000
        ]),
    ];
});
