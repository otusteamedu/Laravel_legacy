<?php


namespace App\Http\Controllers\Publica;


use App\Base\Controller\AbstractController;
use App\Helpers\Views\AdminHelpers;
use App\Models\Movie;
use App\Models\MovieShowing;
use App\Services\Interfaces\IMovieService;
use App\Services\Interfaces\IMovieShowingService;
use App\Services\Interfaces\IPlaceService;
use App\Services\Interfaces\IShowingPriceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovieShowingController extends AbstractController
{
    /**
     * @var IMovieService
     */
    private $movieService;
    /**
     * @var IMovieShowingService
     */
    private $movieShowingService;
    /**
     * @var IShowingPriceService
     */
    private $showingPriceService;

    public function __construct(
        IMovieService $movieService,
        IMovieShowingService $movieShowingService,
        IShowingPriceService $showingPriceService
    ) {
        $this->movieService = $movieService;
        $this->movieShowingService = $movieShowingService;
        $this->showingPriceService = $showingPriceService;
    }

    public function showing(int $movieId, Request $request): View {
        /** @var Movie $model */
        $model = $this->movieService->findModel($movieId);

        $filter_date = $request->get('filter_date', '');
        $date = null;
        try {
            $date = Carbon::createFromFormat(AdminHelpers::FORMAT_SITE_DATE, $filter_date);
        }
        catch (\Exception $e) {
            $date = Carbon::now();
            $filter_date = $date->format(AdminHelpers::FORMAT_SITE_DATE);
        }

        $moviesShowing = $this->movieShowingService->getMovieShowings($date, $model);
        $movie = $model->toArray();
        return view('public.movies.showing',
            compact('movie', 'moviesShowing', 'filter_date')
        );
    }

    /**
     * 1. Получить зал, связанный с сеансом
     * 2. Получить все места в зале (место, цена, тариф)
     * 3. Получить занятые места
     *
     * @param int $showingId
     * @param IPlaceService $placeService
     * @return View
     */
    public function order(int $showingId, IPlaceService $placeService): View {
        /** @var MovieShowing $showingModel */
        $showingModel = $this->movieShowingService->findModel($showingId);

        $showing = $showingModel->toArray();
        $showing['date'] = $showingModel->datetime->format(AdminHelpers::FORMAT_SITE_DATE);
        $showing['time'] = $showingModel->datetime->format(AdminHelpers::FORMAT_SITE_TIME);

        $hallModel = $showingModel->hall;
        $hall = $hallModel->toArray();
        $hall['cinema'] = $hallModel->cinema->toArray();

        $movieModel = $showingModel->movieRental->movie;
        $movie = $movieModel->toArray();

        $places = $placeService->getPlacesInHall($hallModel);

        $prices = $this->showingPriceService->getShowingPrices($showingModel);

        return view('public.movies.order',
            compact('movie', 'places', 'hall', 'showing', 'prices')
        );
    }

    public function addticket(int $showingId, Request $request): View {

    }
}
