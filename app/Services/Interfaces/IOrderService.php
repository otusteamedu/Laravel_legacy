<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\Interfaces\Adapters\IProduct;

interface IOrderService extends IBaseService
{
    // создать заказ
    public function createOrder(): Order;
    // удалить заказ
    public function destroyOrder(Order $order);
    public function getOrderSession(): Order;
    public function getUserOrder(User $user, string $order_number): ?Order;
    // добавить "продукт" в корзину
    public function addSessProduct(IProduct $product): OrderItem;
    // добавить "продукт" к заказу
    public function addProduct(Order $order, IProduct $product): OrderItem;
    //
    public function addProducts(Order $order, array $products): array;
    public function removeProduct(Order $order, IProduct $product): Order;
    //
    public function removeSessProduct(IProduct $product): Order;
    public function getOrderItems(Order $order): array;
    public function getOrderItem(Order $order, int $item_id): OrderItem;
    public function getProducts(Order $order): array;
    public function updateOrderSession(): Order;
    public function clearOrderSession(): Order;
    public function confirmOrderSession(array $contactData): Order;
    public function placeOrder(User $buyer, array $products, array $contactData): Order;
    public function summaryOrderSession(): array;
}
