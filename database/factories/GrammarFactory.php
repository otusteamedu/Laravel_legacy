<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Grammar::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'title' => $faker->words(3, true),
        'code' => $faker->ean13,
        'meta_keywords' => $faker->words(3, true),
        'meta_description' => $faker->words(3, true),
        'grammar_text' => $faker->text($maxNbChars = 2000),
        'arabic_text' => "ٌ. أَنَا مُؤَذِّنٌ. هُمْ عُلَمَاءُ. هُنَّ جَاهِلاَتٌ.",
    ];
});
