<?php

use App\Models\Episode;
use App\Models\Podcast;
use Illuminate\Database\Seeder;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Генерируя случайные эпизоды, будем привызвать их к первым двум подкастам (по алфавиту),
        // чтобы не размазывать по всем 50+ подкастам.
        $firstTwoPodcasts = Podcast::orderBy('name')->take(2)->get()->toArray();

        factory(Episode::class, 150)->create()->each(function($episode) use ($firstTwoPodcasts) {

            // Номер эпизода будем брать не случайным, а последовательным
            // найдём максимальный из уже внесённых в базу номеров
            /** @var Podcast $randomPodcast */
            $randomPodcast = $firstTwoPodcasts[array_rand($firstTwoPodcasts)];
            $maxNo = Episode::where('podcast_id', $randomPodcast['id'])->max('no');

            /** @var Episode $episode */
            $episode->update(['no' => $maxNo + 1, 'podcast_id' => $randomPodcast['id']]);
        });
    }
}
