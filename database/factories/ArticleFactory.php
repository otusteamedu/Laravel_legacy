<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => 'Article about ' . $faker->realText(20),
        'description' => $faker->realText(200),
    ];
});
