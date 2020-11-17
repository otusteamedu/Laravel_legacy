<?php

namespace App\Http\Controllers;

use App\Services\BusesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusesController extends Controller
{
    protected $busesService;

    public function __construct(
        BusesService $busesService
    )
    {
        $this->busesService = $busesService;
    }

    public function index()
    {
        $view = view('bus', ['items' => $this->busesService->getList() ])->render();

        return (new Response($view));
    }

    public function check(Request $request)
    {
        $this->busesService->check($request);
    }

    public function formcheck()
    {
        $view = view('checkbus')->render();

        return (new Response($view));
    }
}
