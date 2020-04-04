<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Blog\BlogArticle::class, function (Faker $faker) {
    $arArticle = [
        'name' => $faker->text,
        'text' => $faker->text(1000)
    ];

    return $arArticle;
});
