<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->sentence(2);

    return [
        'name' => $name,
        'slug' => Str::slug($name)
    ];
});
