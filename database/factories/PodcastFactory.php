<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Podcast;
use Faker\Generator as Faker;

$factory->define(Podcast::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'author' => $faker->name,
        'copyright' => $faker->company,
        'category' => $faker->word,
        'keywords' => implode(', ', $faker->words(5)),
        'website' => 'https://' . $faker->domainName,
        'shownotes_footer' => $faker->paragraph,
        'episode_name_template' => '#{no}'
    ];
});
