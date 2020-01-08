<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'content' => $faker->realText(400),
        'slug' => $faker->slug(10),
        'title' => $faker->text(30),
        'keywords' => $faker->text(20),
        'description' => $faker->text(50),
    ];
});
