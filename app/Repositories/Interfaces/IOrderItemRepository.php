<?php


namespace App\Repositories\Interfaces;

use App\Base\Repository\IBaseRepository;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interfaces\Adapters\IProduct;
use Illuminate\Database\Eloquent\Collection;

interface IOrderItemRepository extends IBaseRepository {
    public function getOrderItems(Order $order): Collection;
    public function findByProductId(Order $order, int $product_id): ?OrderItem;
    public function findByItemId(Order $order, int $item_id): ?OrderItem;
}
