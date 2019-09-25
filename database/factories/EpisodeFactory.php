<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Episode;
use Faker\Generator as Faker;

$factory->define(Episode::class, function (Faker $faker) use (&$nextNo) {
    return [
        'name' => $faker->words(4, true),
        'show_notes' => $faker->paragraph,
    ];
});
