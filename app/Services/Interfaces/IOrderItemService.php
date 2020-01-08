<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interfaces\Adapters\IProduct;
use Illuminate\Database\Eloquent\Collection;

interface IOrderItemService extends IBaseService {
    public function UpdateItem(OrderItem $item): bool;
    public function removeItem(Order $order, OrderItem $item): OrderItem;
    public function getProduct(OrderItem $item): ?IProduct;
    public function IsProductInOrder(Order $order, IProduct $product): bool;
    public function getOrderItems(Order $order): Collection;
    public function getOrderItem(Order $order, int $item_id): OrderItem;
    public function addProduct(Order $order, IProduct $product): OrderItem;
    public function removeProduct(Order $order, IProduct $product): OrderItem;
}
