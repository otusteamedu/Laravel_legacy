<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Base\Service\Q;
use App\Models\Cinema;
use App\Models\Movie;
use App\Repositories\Interfaces\IMovieShowingRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
        return $date->floorDay();
    }

    private function availableDatesQuery(Movie $movie = null, Cinema $cinema = null, Carbon $date_from = null, Carbon $date_to = null) {
        $query = DB::table('movie_showings')
            ->selectRaw('date(movie_showings.`datetime`) as `date`')
            ->join('movie_rentals', 'movie_rentals.id', 'movie_showings.movie_rental_id')
            ->groupBy('date')
            ->orderBy('movie_showings.datetime');

        if($movie)
            $query->where('movie_rentals.movie_id', '=', $movie->id);
        if($cinema)
            $query->where('movie_rentals.cinema_id', '=', $movie->id);
        if($date_from)
            $query->where('movie_rentals.datetime', '>=', $date_from->ceilDay());
        if($date_to)
            $query->where('movie_rentals.datetime', '<', $date_to->addDay()->floorDay());

        return $query;
    }
    /**
     * @inheritDoc
     */
    public function availableDates(Carbon $date_from = null, Carbon $date_to = null): array {
        return $this->availableDatesQuery(null, null, $date_from, $date_to)->pluck('date')->toArray();
    }
    /**
     * @inheritDoc
     */
    public function availableMovieDates(Movie $movie, Carbon $date_from = null, Carbon $date_to = null): array {
        return $this->availableDatesQuery($movie, null, $date_from, $date_to)->pluck('date')->toArray();
    }
    /**
     * @inheritDoc
     */
    public function availableCinemaDates(Cinema $cinema, Carbon $date_from = null, Carbon $date_to = null): array {
        return $this->availableDatesQuery(null, $cinema, $date_from, $date_to)->pluck('date')->toArray();
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
