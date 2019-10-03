<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => uniqueCity($faker),
    ];
});

if (!function_exists('uniqueCity')) {
    function uniqueCity(Faker $faker)
    {
        $name = $faker->unique()->city;
        if (\App\Models\City::where('name', $name)->count()) {
            return uniqueCity($faker);
        }
        return $name;
    }
}
