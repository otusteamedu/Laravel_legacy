<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Genre::class, function (Faker $faker) {

    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');

    $arGenres = ["Комедия", "Драма", "Боевик", "Триллер", "Ужасы"];

    $genre = $faker->unique()->randomElement($arGenres);

    return [
        "name"=>$genre,
        "slug"=>Str::slug($genre),
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
