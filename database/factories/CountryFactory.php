<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(\App\Models\Country::class, function (Faker $faker) {
    $continents = [
        'Europe',
        'Asia',
        'USA',
    ];

    shuffle($continents);
    $continent = array_shift($continents);
    return [
        'name' => uniqueCountryName($faker),
        'continent_name' => $continent,
    ];
});

function uniqueCountryName(Faker $faker) {
    $name = $faker->unique()->country;
    if (\App\Models\Country::where('name', $name)->count()) {
        return uniqueCountryName($faker);
    }
    return $name;
}
