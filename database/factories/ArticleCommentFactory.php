<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ArticleComment;
use Faker\Generator as Faker;
use App\Models\User;
use Faker\Factory as FakerFactory;

$factory->define(ArticleComment::class, function (Faker $faker) {
    $faker = FakerFactory::create('Ru_RU');
    return [
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
        'text' => $faker->realText(),
        'user_id'=> User::all()->random()
    ];
});
