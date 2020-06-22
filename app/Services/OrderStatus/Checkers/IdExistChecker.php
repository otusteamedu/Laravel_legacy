<?php

namespace App\Services\OrderStatus\Checkers;

use App\Services\OrderStatus\Exceptions\IdDoesntExsistException;
use App\Services\OrderStatus\Repositories\OrderStatusRepositoryInterface;

class IdExistChecker
{
    protected $orderStatusRepository;

    public function __construct(
        OrderStatusRepositoryInterface $orderStatusRepository
    ) {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function check(int $id): void
    {
        if (!$this->orderStatusRepository->find($id)) {
            throw new IdDoesntExsistException('Order status with id=' . $id . ' doesn\'t exist');
        }
    }
}
