<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Podcast;
use Faker\Generator as Faker;

$factory->define(Podcast::class, function (Faker $faker) {

    $randomCategory = DB::select("SELECT id FROM categories_itunes ORDER BY RAND() LIMIT 1");

    return [
        'name' => $faker->words(3, true),
        'description' => $faker->paragraph,
        'author' => $faker->name,
        'copyright' => $faker->company,
        'keywords' => implode(', ', $faker->words(5)),
        'website' => 'https://' . $faker->domainName,
        'show_notes_footer' => $faker->paragraph,
        'episode_name_template' => '#{no}',
        'category_itunes_id' => $randomCategory[0]->id,
    ];
});
