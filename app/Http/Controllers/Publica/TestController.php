<?php


namespace App\Http\Controllers\Publica;


use App\Base\Service\ServiceException;
use App\Http\Controllers\Controller;
use App\Services\Exceptions\TicketException;
use Carbon\Carbon;

class TestController extends Controller {
    public function index(
        \App\Services\Interfaces\IMovieService $movieService,
        \App\Services\Interfaces\IMovieShowingService $movieShowingService
    ) {
        dd($movieShowingService->availableMovieDates(
            $movieService->findModel(44)
        ));
    }
}
