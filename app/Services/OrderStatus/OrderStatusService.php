<?php

namespace App\Services\OrderStatus;

use App\Models\OrderStatus;
use App\Services\OrderStatus\Repositories\EloquentOrderStatusRepository;

class OrderStatusService
{
    protected $orderStatusRepository;

    public function __construct(
        EloquentOrderStatusRepository $orderStatusRepository
    ) {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function all()
    {
        return $this->orderStatusRepository->all();
    }
}
