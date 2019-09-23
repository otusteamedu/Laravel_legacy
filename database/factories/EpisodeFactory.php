<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Episode;
use App\Models\Podcast;
use Faker\Generator as Faker;

$nextNo = [];

$factory->define(Episode::class, function (Faker $faker) use (&$nextNo) {

    // Генерируя случайные эпизоды, будем привызвать их к первым двум подкастам (по алфавиту),
    // чтобы не размазывать по всем 50+ подкастам.
    $firstTwoPodcasts = Podcast::orderBy('name')->take(2)->get();
    $podcast = $faker->randomElement($firstTwoPodcasts);

    // Номер эпизода будем брать не случайным, а последовательным
    // найдём максимальный из уже внесённых в базу номеров
    if (!isset($nextNo[$podcast->id])) {
        $maxNo = Episode::where('podcast_id', $podcast->id)->max('no');
        // и увеличим на единицу
        $nextNo[$podcast->id] = $maxNo + 1;
    } else {
        $nextNo[$podcast->id]++;
    }

    return [
        'name' => $faker->words(4, true),
        'shownotes' => $faker->paragraph,
        'no' => $nextNo[$podcast->id],
        'podcast_id' => $podcast->id,
    ];
});
