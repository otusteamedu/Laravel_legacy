<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Base\Service\CD;
use App\Helpers\Views\AdminHelpers;
use App\Http\Controllers\Traits\FilterTrait;
use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IGenreService;
use App\Services\Interfaces\IMovieService;
use App\Services\ResizeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovieController extends AbstractController
{
    use FilterTrait;
    /**
     * @var IMovieService
     */
    private $movieService;
    /**
     * StartController constructor.
     * @param IMovieService $movieService
     * @param IGenreService $genreService
     * @param ICinemaService $cinemaService
     */
    public function __construct(
        IMovieService $movieService,
        IGenreService $genreService,
        ICinemaService $cinemaService
    ) {
        $this->movieService = $movieService;
        $this->genreService = $genreService;
        $this->cinemaService = $cinemaService;
    }

    public function index(Request $request): View
    {
        $fd = $this->initFilterData($request);

        $navPages = [
            'per_page' => (int) $request->get('per_page', 12)
        ];

        $date = null;
        try {
            $date = Carbon::createFromFormat(AdminHelpers::FORMAT_SITE_DATE, $fd['filter_date']);
        }
        catch (\Exception $e) {
            $date = Carbon::now();
        }

        $showingMovies = $this->movieService->FindMovies($date, $navPages, [
            'genreId' => $fd['filter_genreId'],
            'cinemaId' => $fd['filter_cinemaId']
        ]);
        $this->makeThumbs($showingMovies, 'poster',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 360, 'height' => 215]);

        $filter_genres = $this->genreService->availableGenres(Carbon::now());
        $filter_cinemas = $this->cinemaService->availableCinemas(Carbon::now());

        //$showingMovies
        return view('public.movies.index',
            array_merge(
                compact(
                    'navPages',
                    'showingMovies',
                    'navPages'
                ),
                $fd
            )
        );
    }

    public function view(int $movieId, Request $request): View
    {
        $movie = $this->movieService->FindMovie($movieId);
        $this->makeThumb($movie, 'poster');

        $fd = $this->initFilterData($request);

        $showingMovies = $this->movieService->getInRentalRandCached(6, new CD('rand_showing', 3600*12, ['rand_premier', 'all_movies']));
        $this->makeThumbs($showingMovies, 'poster',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 360, 'height' => 215]);

        return view('public.movies.view',
            array_merge(
                ['movie' => $movie, 'showingMovies' => $showingMovies],
                $fd
            )
        );
    }
}
