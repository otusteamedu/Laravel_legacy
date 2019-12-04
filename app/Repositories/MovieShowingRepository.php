<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Base\Service\Q;
use App\Models\Cinema;
use App\Models\Movie;
use App\Repositories\Interfaces\IMovieShowingRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MovieShowingRepository extends BaseRepository implements IMovieShowingRepository
{

    private function validDateRange(Carbon $date_from, Carbon $date_to): bool {
        if($date_from->gt($date_to)) {
            $r = $date_from;
            $date_from = $date_to;
            $date_to = $r;
        }
        return true;
    }
    private function prepareFrom(Carbon $date): Carbon {
        return $date->ceilDay();
    }
    /**
     * @inheritDoc
     */
    public function availableDates(Carbon $date_from, Carbon $date_to): array
    {


        return [];
    }
    /**
     * @inheritDoc
     */
    public function availableMovieDates(Movie $movie , Carbon $date_from , Carbon $date_to): array
    {
        return [];
    }
    /**
     * @inheritDoc
     */
    public function availableCinemaDates(Cinema $cinema , Carbon $date_from , Carbon $date_to): array
    {
        return [];
    }

    /**
     * @inheritDoc
     * @throws \App\Base\WrongNamespaceException
     */
    public function getMovieShowings(Carbon $date, Movie $movie, bool $checkDate = true): Collection {
        return $this->getList(
            (new Q)
                ->filter(['date' => $date, 'movieId' => $movie->id, 'check_date' => $checkDate])
        );
    }

    /**
     * @inheritDoc
     * @throws \App\Base\WrongNamespaceException
     */
    public function getCinemaShowings(Carbon $date, Cinema $cinema, bool $checkDate = true): Collection {
        return $this->getList(
            (new Q)
                ->filter(['date' => $date, 'cinemaId' => $cinema->id, 'check_date' => $checkDate])
        );
    }
}
