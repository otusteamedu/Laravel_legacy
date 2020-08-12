<?php

namespace App\Services\Events\Models\Film;

use App\Models\Film;

abstract class FilmEvent
{

    /** @var Film */
    private $film;

    public function __construct(Film $film)
    {
        $this->film = $film;
    }

    /**
     * @return Film
     */
    public function getFilm(): Film
    {
        return $this->film;
    }
}