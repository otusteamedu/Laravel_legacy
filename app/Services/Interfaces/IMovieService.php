<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use Carbon\Carbon;

interface IMovieService extends IBaseService
{
    public function getSoonInRental(int $nLastCount): array;

    public function getInRentalRand(int $nCount): array;

    /**
     * Найти фильмы по фильтру
     *
     * @param Carbon $date
     * @param array $navPages
     * @param array $filters
     * @return array
     */
    public function FindMovies($date, array &$navPages, array $filters = []): array;
    /**
     * @param int $movieId
     * @return array
     */
    public function FindMovie(int $movieId): array;
}
