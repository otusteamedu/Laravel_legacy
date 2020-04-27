<?php

namespace App\Http\Controllers\API\Cms\Order;


use App\Http\Controllers\API\Cms\Order\Requests\ChangeStatusRequest;
use App\Services\Order\CmsOrderService;
use Illuminate\Http\JsonResponse;

class OrderController
{
    private CmsOrderService $service;

    /**
     * OrderController constructor.
     * @param CmsOrderService $service
     */
    public function __construct(CmsOrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function getItems(): JsonResponse
    {
        return response()->json($this->service->getItems());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getItem(int $id): JsonResponse
    {
        return response()->json($this->service->getItem($id));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getItemDetails(int $id): JsonResponse
    {
        return response()->json($this->service->getItemDetails($id));
    }

    /**
     * @param ChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id ): JsonResponse
    {
        return response()->json($this->service->changeStatus($id, $request->all()));
    }
}
