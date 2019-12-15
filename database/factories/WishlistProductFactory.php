<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WishlistProduct;
use Faker\Generator as Faker;

$factory->define(WishlistProduct::class, function (Faker $faker) {
    return [
        'wishlist_id'    => App\Models\Wishlist::pluck('id')->random(),
        'product_id'     => App\Models\ProductsSnapshot::pluck('productId')->random(),
        'expected_price' => $faker->randomFloat(2, 0, 100),
    ];
});
