<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RoomOccupation;
use Faker\Generator as Faker;

$factory->define(RoomOccupation::class, function (Faker $faker) {
    return [
        'date' => $faker->date('Y-m-d', '+ 1 year'),
    ];
});
