<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words(5, true),
        'body' => $faker->text,
        'published_at' => rand(0, 1) ? $faker->date('Y-m-d H:i:s', '+ 1 month') : null,
    ];
});
