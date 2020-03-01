<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Country::class, function (Faker $faker) {
    $continents = [
        'Евразия',
        'Африка',
        'Северная Америка',
        'Южная Америка',
        'Австралия',
        'Антарктида',
    ];
    shuffle($continents);
    $continent = array_shift($continents);
    return [
        'name' => $faker->country,
        'continent_name' => $continent,
    ];
});
