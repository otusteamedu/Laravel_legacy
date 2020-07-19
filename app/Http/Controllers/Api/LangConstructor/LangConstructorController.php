<?php

namespace App\Http\Controllers\Api\LangConstructor;

use App\Http\Controllers\Controller;
use App\Services\Constructions\ConstructionsService;
use App\Http\Resources\ConstructionsResource;

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
        $constructions = $this->constructionsService->getAllConstructionCached();

        return response()->json(new ConstructionsResource($constructions));
    }

}
