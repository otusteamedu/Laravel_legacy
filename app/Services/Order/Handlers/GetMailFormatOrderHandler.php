<?php


namespace App\Services\Order\Handlers;


use App\Models\Order;

class GetMailFormatOrderHandler
{
    /**
     * @param Order $order
     * @return array
     */
    public function handle(Order $order): array
    {
        $items = json_decode($order->items, true);
        $delivery = json_decode($order->delivery, true);
        $customer = json_decode($order->customer, true);
        $goodQty = $this->getGoodsQtyString($items);

        return [
            'number' => $order->number,
            'date' => $order->created_at->format('d.m.Y'),
            'status' => $order->statuses->last()->title,
            'items' => $this->getPreparedItems($items),
            'delivery' => $delivery,
            'customer' => $customer,
            'goodsQty' => $goodQty,
            'price' => $order->price,
            'comment' => $order->comment
        ];
    }

    /**
     * @param array $items
     * @return string
     */
    private function getGoodsQtyString(array $items): string
    {
        return $this->getGoodsQty($items) . ' ' . wordsDeclension($this->getGoodsQty($items), [
            'ТОВАР',
            'ТОВАРА',
            'ТОВАРОВ'
        ]);
    }

    /**
     * @param array $items
     * @return int
     */
    private function getGoodsQty(array $items): int
    {
        return array_reduce($items, function($carry, $item) {
            $carry += $item['qty'];
            return $carry;
        }, 0);
    }

    /**
     * @param array $items
     * @return array
     */
    private function getPreparedItems(array $items): array
    {
        return array_map(function($item) {
            return $this->getPreparedItem($item);
        }, $items);
    }

    /**
     * @param array $item
     * @return array
     */
    private function getPreparedItem(array $item): array
    {
        return [
            'thumbPath' => env('APP_URL', 'manager.calipari.ru') . $item['thumbPath'],
            'article' => getImageArticle($item['imageId']),
            'dimensions' => $item['width'] . ' см × ' . $item['height'] . ' см',
            'texture' => $item['texture']['name'],
            'filter' => $item['filterString'],
            'qty' => $item['qty'],
            'price' => $item['price'] * $item['qty']
        ];
    }
}
