<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "text" => $faker->paragraph,
        "user_id" => factory(App\Models\User::class),
        "complex_id" => factory(App\Models\Complex::class)
    ];
});
