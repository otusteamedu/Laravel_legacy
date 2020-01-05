<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'image' => $faker->image('public/storage/images',640,480, null, false),
        'content' => $faker->realText(400),
        'link' => $faker->url,
        'slug' => $faker->slug(10),
        'title' => $faker->text(20),
        'keywords' => $faker->text(20),
        'description' => $faker->text(50),
    ];
});
