<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        "title" => $faker->unique()->company,
        "description" => $faker->text(70),
        "publish" => 1
    ];
});
