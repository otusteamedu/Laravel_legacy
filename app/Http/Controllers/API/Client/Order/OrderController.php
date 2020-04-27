<?php

namespace App\Http\Controllers\API\Client\Order;

use App\Http\Controllers\API\Client\Order\Requests\StoreRequest;
use App\Services\Order\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController
{
    private OrderService $service;

    /**
     * OrderController constructor.
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }
}
