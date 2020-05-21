<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advert;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
*/

$factory->define(Advert::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ru_Ru');
    return [
        'user_id' => $faker->numberBetween(1, 2),
        'town_id' => $faker->numberBetween(1, 3),
        'division_id' => $faker->numberBetween(1, 4),
        'title' => $faker->sentence(3),
        'price' => $faker->numberBetween(500000 , 5000000),
        'img' => 'img-'.$faker->numberBetween(1 , 10).'.jpg',
        'content' => implode(' ',$faker->sentences(3)),
    ];
});
