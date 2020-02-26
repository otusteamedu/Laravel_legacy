<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'status' => $faker->boolean,
        'image' => $faker->imageUrl(320, 240, 'cats', true),
        'url' => '',
        'group' => $faker->unique()->numberBetween(1,20),
        'data' => [
            'ru' => [
                'name' => $faker->text(20),
                'description' => $faker->text(250),
            ],
            'en' => [
                'name' => $faker->text(20),
                'description' => $faker->text(250),
            ],
        ],
    ];
});
