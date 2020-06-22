<?php

namespace App\Services\Order\Repositories;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function find(int $id): ?Order;
    public function updateFromArray(Order $order, array $data): Order;
    public function updateProductsFromArray(Order $order, array $products): Order;
    public function fillFromArray(Order $order, array $data): Order;
    public function findWith(int $id, array $relations): ?Order;
}
