<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Town;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
*/

$factory->define(Town::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ru_Ru');
    return [
        'name' => $faker->unique()->city,
    ];
});
