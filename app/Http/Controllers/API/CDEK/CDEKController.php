<?php

namespace App\Http\Controllers\API\CDEK;


use App\Http\Requests\FormRequest;
use App\Services\CDEK\CDEKService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CDEKController extends Controller
{
    private CDEKService $service;

    /**
     * CDEKController constructor.
     * @param CDEKService $service
     */
    public function __construct(CDEKService $service)
    {
        $this->service = $service;
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    public function getPVZS(FormRequest $request): JsonResponse
    {
        return response()->json($this->service->getPVZS($request->all()));
    }

    /**
     * @param FormRequest $request
     * @return JsonResponse
     */
    function getSettlements(FormRequest $request): JsonResponse
    {
        return response()->json($this->service->getSettlements($request->all()));
    }

    /**
     * @param FormRequest $request
     * @return int
     */
    public function getPrice(FormRequest $request): int
    {
        return $this->service->getPrice($request->all());
    }
}
