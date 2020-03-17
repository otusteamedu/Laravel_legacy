<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Article\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {

    return [
        'title' => $faker->title,
        'text' => $faker->text,
        'image_url' => 'https://via.placeholder.com/362x180',
        'published' => $faker->boolean(90),
    ];
});
