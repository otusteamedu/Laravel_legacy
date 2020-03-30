<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Blog\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
