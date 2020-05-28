<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'content' => $faker->paragraphs(10, true),
        'route' => $faker->slug
    ];
});
