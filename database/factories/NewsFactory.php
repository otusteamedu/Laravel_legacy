<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'name' => 'News about ' . $faker->realText(20),
        'description' => $faker->realText(200),
    ];
});
