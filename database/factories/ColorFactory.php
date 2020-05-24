<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Color;
use Faker\Generator as Faker;

$factory->define(Color::class, function (Faker $faker) {
    $color = $faker->colorName;
    return [
        'name' => $color,
        'name_ru' => $color . 'Ru'
    ];
});
