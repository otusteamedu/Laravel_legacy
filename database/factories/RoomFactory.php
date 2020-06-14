<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->numberBetween(1, 1000),
    ];
});
