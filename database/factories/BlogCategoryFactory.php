<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Intervention\Image\Facades\Image;
use \App\Helpers\File\Helper;

$factory->define(App\Models\Blog\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
