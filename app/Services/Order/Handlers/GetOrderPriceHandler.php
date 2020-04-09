<?php


namespace App\Services\Order\Handlers;


class GetOrderPriceHandler
{
    /**
     * @param array $orderItems
     * @param int $deliveryPrice
     * @return int
     */
    public function handle(array $orderItems, int $deliveryPrice): int
    {
        return array_reduce($orderItems, function($carry, $item) {
            $carry += $item['price'] * $item['qty'];

            return $carry;
        }, $deliveryPrice);
    }
}
