<?php


namespace App\Http\Controllers\Publica;


use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TestController extends Controller {
    public function index(
        \App\Services\Interfaces\IMovieShowingService $service,
        \App\Services\Interfaces\IMovieService $movieService,
        \App\Services\Interfaces\ICinemaService $cinemaService
    ) {
        /** @var \App\Models\Movie $movie */
        $movie = $movieService->findModel(21);
        $cinema = $cinemaService->findModel(6);
        dd($service->getCinemaShowings(Carbon::now(), $cinema));
    }
}
