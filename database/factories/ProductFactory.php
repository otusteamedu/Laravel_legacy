<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'status' => $faker->boolean,
        'url' => '',
        'price' => $faker->numberBetween(100,1000),
        'quantity' => $faker->numberBetween(0,10000),
        'data' => [
            'ru' => [
                'name' => $faker->text(30),
                'description' => $faker->text(250),
            ],
            'en' => [
                'name' => $faker->text(30),
                'description' => $faker->text(250),
            ],
        ],
    ];
});
