<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $totalCount = rand(50, 100);
    $remainingCount = rand($totalCount - 20, $totalCount);
    return [
        'name' => $faker->title,
        'price' => rand(1000, 4000) / 100,
        'total_count' => $totalCount,
        'remaining_count' => $remainingCount,
    ];
});
