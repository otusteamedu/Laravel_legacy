<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$dir = 'app/public/images/';
$width = 100;
$height = 100;

$factory->define(Category::class, function (Faker $faker) use ($dir, $width, $height) {
    return [
        'name' => $faker->word(),
        'type' => $faker->numberBetween($min = 0, $max = 1),
//        'img' => $dir . $faker->image(storage_path($dir),640,480, 'cats', false)
    'img' => $dir
    ];
});

$factory->state(Category::class, 'type_income', [
    'id' => 1,
    'type' => 1,
]);

$factory->state(Category::class, 'type_consumption', [
    'id' => 2,
    'type' => 0,
]);