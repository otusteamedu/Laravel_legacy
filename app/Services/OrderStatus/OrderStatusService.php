<?php

namespace App\Services\OrderStatus;

use App\Services\OrderStatus\Repositories\OrderStatusRepositoryInterface;

class OrderStatusService
{
    protected $orderStatusRepository;

    public function __construct(
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function all()
    {
        return $this->orderStatusRepository->all();
    }
}
