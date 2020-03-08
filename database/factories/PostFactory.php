<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Post;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->text(100),
        'img' => $faker->image(),
        'price' => $faker->randomFloat(2, 0, 100),
        'category_id' => function() {
            return factory(Category::class)->create()->id;
        },
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'type_id' => $faker->randomElement([1, 2]),
        'confirm' => $faker->boolean,
        'time_over' => $faker->dateTime(), // Как прибавить случайное число к now?
        'is_actual' => $faker->boolean,
    ];
});
