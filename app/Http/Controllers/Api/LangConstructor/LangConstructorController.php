<?php

namespace App\Http\Controllers\Api\LangConstructor;

use App\Http\Controllers\Controller;
use App\Services\Constructions\ConstructionsService;
use App\Http\Resources\ConstructionsResource;
use Cache;
class LangConstructorController extends Controller
{
    protected $constructionsService;


    public function __construct(
        ConstructionsService $constructionsService
    )
    {
        $this->constructionsService = $constructionsService;

    }

    public function index()
    {

        dump(LARAVEL_START);
        $constructions = $this->constructionsService->getAllConstructionCached();
        dump( microtime(true));

      return response()->json(new ConstructionsResource($constructions));
    }

}
