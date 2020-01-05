<?php

namespace App\Http\Controllers\API\Cms\Format;


use App\Services\Format\FormatService;
use Illuminate\Http\JsonResponse;

class FormatController
{
    /**
     * @var FormatService
     */
    protected $service;

    /**
     * CategoryController constructor.
     * @param FormatService $service
     */
    public function __construct(FormatService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse {
        return response()->json($this->service->getAll());
    }
}
