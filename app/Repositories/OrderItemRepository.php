<?php


namespace App\Repositories;

use App\Base\Repository\BaseRepository;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interfaces\IOrderItemRepository;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository extends BaseRepository implements IOrderItemRepository {
    public function getOrderItems(Order $order): Collection
    {
        return $this->getModel()->newQuery()
            ->where('order_id', $order->id)
            ->get();
    }

    public function findByProductId(Order $order, int $product_id): ?OrderItem
    {
        return $this->getModel()->newQuery()
            ->where('order_id', $order->id)
            ->where('product_id', $product_id)
            ->get()->first();
    }

    public function findByItemId(Order $order, int $item_id): ?OrderItem
    {
        return $this->getModel()->newQuery()
            ->where('order_id', $order->id)
            ->where('id', $item_id)
            ->get()->first();
    }
}

