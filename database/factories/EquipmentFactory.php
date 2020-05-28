<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Equipment;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'image' => $faker->imageUrl(),
        'weight' => $faker->randomElement("", "10", "15", "16", "20", "22", "24", "32", "40", "50")
    ];
});
