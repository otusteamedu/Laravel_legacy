<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\Interfaces\Adapters\IProduct;

interface IOrderRepository extends IBaseRepository {
    /**
     * @param $session_id
     * @return Order|null
     */
    public function getOrderSession(string $session_id): ?Order;
    public function getUserOrder(User $user, string $order_number): ?Order;
}
