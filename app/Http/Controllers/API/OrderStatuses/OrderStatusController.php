<?php

namespace App\Http\Controllers\API\OrderStatuses;

use App\Http\Controllers\Controller;
use App\Services\OrderStatus\OrderStatusService;

class OrderStatusController extends Controller
{
    protected $orderStatusService;

    public function __construct(
        OrderStatusService $orderStatusService
    ) {
        $this->orderStatusService = $orderStatusService;
    }

    public function getAll()
    {
        return response()->json(
            $this->orderStatusService->all()
        );
    }
}
