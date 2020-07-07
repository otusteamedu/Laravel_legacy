<?php

namespace Tests\Generators;

use App\Models\Film;

class FilmGenerator
{

    /* public static function createRussia(array $data = [])
    {
    return self::createCountry(array_merge($data, [
    'name' => 'Russia',
    'continent_name' => 'Europe',
    ]));
    }
     */

    public static function createFilm(array $data = []): Film
    {
        return factory(Film::class)->create($data);
    }

}