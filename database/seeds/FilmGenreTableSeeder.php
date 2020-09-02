<?php

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\FilmGenre;

class FilmGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = Film::take(5)->get();
        foreach ($films as $film) {
            factory(FilmGenre::class, 2)->create([
                'film_id' => $film->id
            ]);
        }
    }
}
