<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Services\Interfaces\ICinemaService;
use Illuminate\Http\Request;

class CinemaController extends AbstractController {
    private $cinemaService;

    /**
     * CinemaController constructor.
     * @param ICinemaService $cinemaService
     */
    public function __construct(
        ICinemaService $cinemaService
    ) {
        $this->cinemaService = $cinemaService;
    }

    public function index(Request $request)
    {
        $cinemasList = $this->cinemaService->cinemaList();

        return view('public.cinemas.index', compact(
            'cinemasList'
        ));
    }
    public function view(int $cinemaId, Request $request)
    {
        $cinema = $this->cinemaService->FindMovie($cinemaId);
        return view('public.cinemas.item', compact('cinema'));
    }
    public function mapData(Request $request) {
        $cinemasList = $this->cinemaService->cinemaList();
        return response()->json($cinemasList);
    }
}




