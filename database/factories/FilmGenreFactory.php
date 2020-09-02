<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\FilmGenre::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    return [
        'film_id'=>$faker->numberBetween(1,5),
        'genre_id'=>$faker->numberBetween(1,5),
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});
