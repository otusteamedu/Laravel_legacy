<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductsSnapshot;
use Faker\Generator as Faker;

$factory->define(ProductsSnapshot::class, function (Faker $faker) {
    return [
        'productId'        => $faker->randomNumber(8),
        'productTitle'     => $faker->sentence(3),
        'commissionRate'   => $faker->numberBetween(1, 5).'%',
        'originalPrice'    => $faker->numberBetween(1, 3),
        'localPrice'       => $faker->randomFloat(2, 0, 10000)." RUB",
        "salePrice"        => "US $".$faker->randomFloat(2, 0, 1000),
        "evaluateScore"    => $faker->numberBetween(1, 5),
        "lotNum"           => $faker->numberBetween(1, 5),
        "discount"         => $faker->numberBetween(1, 99).'%',
        "30daysCommission" => "US $".$faker->randomFloat(2, 0, 10),
        "packageType"      => rand(0, 1) == true ? 'piece' : 'lot',
        "volume"           => $faker->randomNumber(1),
        "imageUrl"         => $faker->imageUrl,
        "storeUrl"         => $faker->url,
        "commission"       => "US $".$faker->randomFloat(2, 0, 10),
        "validTime"        => Carbon\Carbon::now(),
        "storeName"        => $faker->sentence(2),
        "productUrl"       => $faker->url,
        "allImageUrls"     => implode(',', [$faker->imageUrl, $faker->imageUrl, $faker->imageUrl]),
    ];
});
