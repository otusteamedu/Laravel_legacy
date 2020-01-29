<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 35, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 5500, $indexSize = 2)
    ];
});
