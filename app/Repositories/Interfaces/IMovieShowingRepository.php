<?php


namespace App\Repositories\Interfaces;

use App\Models\Cinema;
use App\Models\Movie;
use Carbon\Carbon;
use App\Base\Repository\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;

interface IMovieShowingRepository extends IBaseRepository
{
    /**
     * Узнать на какие даты есть какие-то сеансы. Используется для указания активных дат в
     * календаре, поэтому активность определяется на отрезке дат. Уже прошедшие даты не учитываются
     *
     * @param Carbon $date_from
     * @param Carbon $date_to
     * @return array
     */
    public function availableDates(Carbon $date_from, Carbon $date_to): array;
    /**
     * Узнать на какие даты есть какие-то сеансы на конкретный фильм.
     *
     * @param Movie $movie
     * @param Carbon $date_from
     * @param Carbon $date_to
     * @return array
     */
    public function availableMovieDates(Movie $movie, Carbon $date_from, Carbon $date_to): array;
    /**
     * Узнать на какие даты есть какие-то сеансы на любые фильмы в конкретном кинотеатре.
     *
     * @param Cinema $cinema
     * @param Carbon $date_from
     * @param Carbon $date_to
     * @return array
     */
    public function availableCinemaDates(Cinema $cinema, Carbon $date_from, Carbon $date_to): array;
    /**
     * Узнать список сеансов на фильм в конкретную дату.
     *
     * @param Carbon $date
     * @param Movie $movie
     * @param bool $checkDate
     * @return Collection
     */
    public function getMovieShowings(Carbon $date, Movie $movie, bool $checkDate = true): Collection;
    /**
     * Узнать список сеансов в кинотеатре в конкретную дату
     *
     * @param Carbon $date
     * @param Cinema $cinema
     * @param bool $checkDate
     * @return Collection
     */
    public function getCinemaShowings(Carbon $date, Cinema $cinema, bool $checkDate = true): Collection;
}


