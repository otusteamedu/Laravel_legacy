<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\MovieShowing;
use App\Repositories\Interfaces\IMovieShowingRepository;
use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IMovieService;
use App\Services\Interfaces\IMovieShowingService;
use Carbon\Carbon;

class MovieShowingService extends BaseService implements IMovieShowingService
{
    protected $movieService;
    protected $cinemaService;

    public function __construct(IMovieService $movieService, ICinemaService $cinemaService) {
        parent::__construct();

        $this->movieService = $movieService;
        $this->cinemaService = $cinemaService;
    }

    public function getMovieShowings(Carbon $date, Movie $movie , bool $checkDate = true): array
    {
        /** @var IMovieShowingRepository $repository */
        $repository = $this->getRepository();
        $showings = $repository->getMovieShowings($date , $movie, $checkDate);
        $result = [];
        $cinemaMap = [];
        /** @var MovieShowing $showing */
        foreach ($showings as $showing) {
            $hall = $showing->hall;
            $cinema = $showing->movieRental->cinema;
            $photos = $cinema->photos;
            $item = [
                'id' => $showing->id,
                'date' => $showing->datetime->format('d.m.Y'),
                'time' => $showing->datetime->format('H:i'),
                'hall' => $hall->toArray()
            ];

            if(!array_key_exists($cinema->id, $cinemaMap)) {
                $index = count($cinemaMap);
                $cinemaMap[$cinema->id] = $index;
                $result[$index] = [
                    'cinema' => $cinema->toArray(),
                    'photo' => (count($photos) ? $photos[0]->toArray() : null),
                    'showings' => []
                ];
            }
            else
                $index = $cinemaMap[$cinema->id];

            $result[$index]['showings'][] = $item;
        }

        return $result;
    }

    public function getCinemaShowings(Carbon $date, Cinema $cinema , bool $checkDate = true): array
    {
        /** @var IMovieShowingRepository $repository */
        $repository = $this->getRepository();
        $showings = $repository->getCinemaShowings($date , $cinema, $checkDate);
        $result = [];
        $movieMap = [];
        /** @var MovieShowing $showing */
        foreach ($showings as $showing) {
            $hall = $showing->hall;
            $movie = $showing->movieRental->movie;

            $item = [
                'id' => $showing->id,
                'date' => $showing->datetime->format('d.m.Y'),
                'time' => $showing->datetime->format('H:i'),
                'hall' => $hall->toArray()
            ];

            if(!array_key_exists($movie->id, $movieMap)) {
                $index = count($movieMap);
                $movieMap[$movie->id] = $index;
                $result[$index] = [
                    'movie' => $movie->toArray(),
                    'photo' => $movie->poster ? $movie->poster->toArray() : null,
                    'showings' => []
                ];
            }
            else
                $index = $movieMap[$movie->id];

            $result[$index]['showings'][] = $item;
        }

        return $result;
    }

    /**
     * Просрочен ли сеанс
     * @param MovieShowing $showing
     * @return bool
     */
    public function ShowingIsExpired(MovieShowing $showing): bool {
        $now = Carbon::now();
        return $showing->datetime->lte($now);
    }
    /**
     * Проверка существования связанных объектов
     * @param MovieShowing $showing
     * @return bool
     */
    public function IsValid(MovieShowing $showing): bool
    {
        $rental = $showing->movieRental;
        if(!$rental || !$rental->cinema || !$rental->movie)
            return false;

        if(!$showing->hall->cinema->is($rental->cinema))
            return false;

        return true;
    }
}
