<?php


namespace App\Http\Controllers\Publica;


use App\Base\Controller\AbstractController;
use App\Base\Service\CD;
use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IGenreService;
use App\Services\Interfaces\IMovieService;
use App\Services\ResizeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StartController extends AbstractController
{
    /**
     * @var IMovieService
     */
    private $movieService;
    private $genreService;
    private $cinemaService;

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
        $fs = $this->FileService();
        $rs = $this->Resizer();

        $premierMovies = $this->movieService->getSoonInRentalCached(4, new CD('top_premier', 3600*24, ['top_premier', 'all_movies']));
        $this->makeThumbs($premierMovies, 'poster');
        $showingMovies = $this->movieService->getInRentalRandCached(6, new CD('rand_showing', 3600*12, ['rand_premier', 'all_movies']));
        $this->makeThumbs($showingMovies, 'poster',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 360, 'height' => 215]);

        $filter_date = $request->get('filter_date', '');
        $filter_genreId = $request->get('filter_genreId', '');
        $filter_cinemaId = $request->get('filter_cinemaId', '');
        $filter_genres = $this->genreService->availableGenres(Carbon::now());
        $filter_cinemas = $this->cinemaService->availableCinemas(Carbon::now());

        return view('public.start.index', compact(
            'premierMovies','showingMovies', 'filter_date', 'filter_genreId',
            'filter_cinemaId', 'filter_genres', 'filter_cinemas'
        ));
    }
    public function about(): View {
        $cinemasList = $this->cinemaService->cinemaList();
        return view('public.about.index', compact(
            'cinemasList'
        ));
    }
}
