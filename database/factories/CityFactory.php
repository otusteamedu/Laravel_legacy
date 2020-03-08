<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Country;
use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'country_id' => function() {
            return factory(Country::class)->create()->id;
        }
    ];
});
