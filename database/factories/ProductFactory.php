<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use App\Models\Color;
use App\Models\Material;
use App\Models\Guarantee;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'price' => rand(100, 1000000) / 100,
        'description' => $faker->text,
        'size' => rand(10, 100),
        'color_id' => rand(1, Color::count()),
        'material_id' => rand(1, Material::count()),
        'guarantee_id' => rand(1, Guarantee::count()),
        'image_path' => $faker->imageUrl()
    ];
});
