<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'title' => $faker->sentence(5),
        'h1' => $faker->sentence(5),
        'description'=>$faker->text,
        'price'=>$faker->randomNumber(4),
        'sku'=>$faker->swiftBicNumber,
    ];
});
