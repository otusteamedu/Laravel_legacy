<?php

namespace App\Services\Order\Repositories;

use App\Services\Order\Repositories\OrderRepositoryInterface;
use App\Models\Order;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function find(int $id): ?Order
    {
        return Order::find($id);
    }

    public function updateFromArray(Order $order, array $data): Order
    {
        if ($order->deleted) {
            if (!isset($data['deleted'])) {
                if ($data['deleted']) {
                    return $order;
                }
            }
        }

        if (isset($data['products'])) {
            $order = $this->updateProductsFromArray($order, $data['products']);
            unset($data['products']);
        }

        $order = $this->fillFromArray($order, $data);

        $order->save();

        return $order;
    }

    public function updateProductsFromArray(Order $order, array $products): Order
    {
        $arrayToSync = [];

        foreach ($products as $product) {
            $arrayToSync[$product['id']] = ['quantity' => $product['quantity']];
        }

        $order->products()->sync($arrayToSync);

        return $order;
    }

    public function fillFromArray(Order $order, array $data): Order
    {
        if (isset($data['status_id'])) {
            $order->status_id = $data['status_id'];
        }

        if (isset($data['deleted'])) {
            $order->deleted = (bool) $data['deleted'];
        }

        return $order;
    }

    public function findWith(int $id, array $relations): ?Order
    {
        $order = $this->find($id);

        if (!$order) {
            return null;
        }

        foreach ($relations as $relation) {
            $order->load($relation);
        }

        return $order;
    }
}
