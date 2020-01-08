<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Base\Service\CD;
use App\Helpers\Views\AdminHelpers;
use App\Http\Controllers\Traits\FilterTrait;
use App\Models\Cinema;
use App\Services\Interfaces\ICinemaService;
use App\Services\Interfaces\IMovieShowingService;
use App\Services\ResizeService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CinemaController extends AbstractController {
    /**
     * @var ICinemaService
     */
    private $cinemaService;
    /**
     * @var IMovieShowingService
     */
    private $movieShowingService;
    /**
     * CinemaController constructor.
     * @param ICinemaService $cinemaService
     */
    public function __construct(
        ICinemaService $cinemaService,
        IMovieShowingService $movieShowingService
    ) {
        $this->cinemaService = $cinemaService;
        $this->movieShowingService = $movieShowingService;
    }

    public function index(Request $request)
    {
        $cinemasList = $this->cinemaService->cinemaListCached(new CD('cinemas_list', 3600*24, ['all_cinemas']));

        $this->makeThumbs($cinemasList, 'photo',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 360, 'height' => 215]);

        return view('public.cinemas.index', compact(
            'cinemasList'
        ));
    }
    public function view(int $cinemaId, Request $request)
    {
        /** @var Cinema $model */
        $model = $this->cinemaService->findModel($cinemaId);

        $cinema = $this->cinemaService->FindCinemaCached($cinemaId, new CD('cinemas_item_'.$cinemaId, 3600*24));
        $this->makeThumb($cinema, 'photos',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 360, 'height' => 240]);

        $filter_date = $request->get('filter_date', '');
        $date = null;
        try {
            $date = Carbon::createFromFormat(AdminHelpers::FORMAT_SITE_DATE, $filter_date);
        }
        catch (\Exception $e) {
            $date = Carbon::now();
            $filter_date = $date->format(AdminHelpers::FORMAT_SITE_DATE);
        }

        //$fd = $this->initFilterData($request);
        $moviesShowing = $this->movieShowingService->getCinemaShowings($date, $model);
        $this->makeThumbs($moviesShowing, 'photo',
            ['type' => ResizeService::RESIZE_CROPPING, 'width' => 100, 'height' => 75]);

        return view('public.cinemas.item',
            array_merge(
                ['cinema' => $cinema, 'moviesShowing' => $moviesShowing],
                ['filter_date' => $filter_date]
            )
        );
    }

    public function mapData(Request $request) {
        $cinemasList = $this->cinemaService->cinemaListCached(new CD('cinemas_list', 3600*24, ['all_cinemas']));
        return response()->json($cinemasList);
    }
}




