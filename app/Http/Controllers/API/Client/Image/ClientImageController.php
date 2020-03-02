<?php

namespace App\Http\Controllers\API\Client\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequest;
use App\Services\Image\ClientImageService;

class ClientImageController extends Controller
{
    private ClientImageService $service;

    public function __construct(ClientImageService $service)
    {
        $this->service = $service;
    }

    public function index(FormRequest $request)
    {
        return response()->json($this->service->index($request->all()));
    }
}
