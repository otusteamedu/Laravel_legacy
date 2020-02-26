<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\ProductImage;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1,30),
        'product_image' => $faker->name,
    ];
});
