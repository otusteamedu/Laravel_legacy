<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Complex;
use Faker\Generator as Faker;

$factory->define(Complex::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
