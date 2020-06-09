<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Page::class, function (Faker $faker) {

    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');

    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);

    return [
        "title"=>$title,
        "meta_title"=>$title,
        "meta_keywords"=>$faker->word,
        "meta_description"=>$faker->text($maxNbChars = 10),
        "slug"=>Str::slug($title),
        "content"=>$faker->text($maxNbChars = 200),
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
