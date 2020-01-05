<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\Rubric;
use Faker\Generator as Faker;

$factory->define(Rubric::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'slug' => $faker->slug(10),
        'title' => $faker->text(20),
        'keywords' => $faker->text(20),
        'description' => $faker->text(50),
    ];
});
