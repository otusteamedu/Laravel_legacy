<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductsSnapshot;
use Faker\Generator as Faker;

$factory->define(ProductsSnapshot::class, function (Faker $faker) {
    return [
        'productId'        => App\Models\Products::pluck('productId')->random(),
        'originalPrice'    => $faker->numberBetween(1, 3),
        'localPrice'       => $faker->randomFloat(2, 0, 10000)." RUB",
        "salePrice"        => "US $".$faker->randomFloat(2, 0, 1000),
        "discount"         => $faker->numberBetween(1, 99).'%',
        "validTime"        => Carbon\Carbon::now(),
    ];
});
