<?php

namespace App\Http\Controllers\API\Orders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\Orders\Requests\PatchOrderRequest;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(
        OrderService $orderService
    ) {
        $this->orderService = $orderService;
    }

    public function get(int $id)
    {
        return response()->json(
            $this->orderService->findWithUserProdutsOrderStatus($id)
        );
    }

    public function patch(PatchOrderRequest $request)
    {
        return response()->json([
            'status' =>
            $this->orderService->patch(
                $request->getformData()
            )
        ]);
    }
}
