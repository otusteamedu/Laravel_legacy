<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Genre;
use Faker\Generator as Faker;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'name' => '',
        'sort' => $faker->randomNumber(2),
        'description' => $faker->text(500)
    ];
});
