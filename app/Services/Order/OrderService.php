<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\Handlers\UpdateOrderHandler;
use App\Services\Order\Repositories\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;
    protected $updateOrderHandler;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UpdateOrderHandler $updateOrderHandler
    ) {
        $this->orderRepository = $orderRepository;
        $this->updateOrderHandler = $updateOrderHandler;
    }

    public function patch($request) :bool
    {
        $ordersToPutch = $request;

        foreach ($ordersToPutch as $orderToPatch) {

            if (!isset($orderToPatch['id'])) {
                continue;
            }

            $order = $this->orderRepository->find($orderToPatch['id']);

            if (!$order) {
                continue;
            }

            unset($orderToPatch['id']);

            $this->updateOrderHandler->handle($order, $orderToPatch);
        }

        return true;
    }

    public function findWithUserProdutsOrderStatus(int $id): ?Order
    {
        return $this->orderRepository->findWith($id, [
            'user',
            'products',
            'orderStatus'
        ]);
    }
}
