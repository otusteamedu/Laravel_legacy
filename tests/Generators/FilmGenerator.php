<?php

namespace Tests\Generators;

use App\Models\Film;

class FilmGenerator
{
    public static function createFilm(array $data = []): Film
    {
        return factory(Film::class)->create($data);
    }
}