<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->realText(),
        'author_id' => rand(1, 50),
        'target_id' => rand(1, 50),
    ];
});
