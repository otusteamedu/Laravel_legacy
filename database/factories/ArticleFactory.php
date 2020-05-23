<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
use App\Models\User;

$factory->define(Article::class, function (Faker $faker) {
    //$faker = FakerFactory::create('Ru_RU');  ERROR:  invalid byte sequence for encoding "UTF8"
    $created_at = $faker->dateTime();
    $text = $faker->realText(5000);
    return [
        'created_at' => $created_at,
        'updated_at' => $created_at,
        'published_at' => $faker->dateTimeBetween($created_at),
        'state' => rand(0, 2),
        'user_id'=> User::all()->random(),
        'hits' => mt_rand(0, 999999),
        'title' => substr($text, 0, 30),
        'image_intro' => $faker->imageUrl(),
        'intro_text' =>substr($text, 0, 50),
        'full_text' => $text
    ];
});
