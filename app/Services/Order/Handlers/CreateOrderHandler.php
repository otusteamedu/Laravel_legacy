<?php


namespace App\Services\Order\Handlers;


use App\Models\Order;
use App\Services\Order\Repositories\ClientOrderRepository;

class CreateOrderHandler
{
    private string $baseUrl;

    private ClientOrderRepository $repository;
    private GetOrderItemsHandler $getOrderItemsHandler;
    private GetOrderDeliveryHandler $getOrderDeliveryHandler;
    private GetOrderCustomerHandler $getOrderCustomerHandler;
    private GetOrderPriceHandler $getOrderPriceHandler;

    /**
     * CreateOrderHandler constructor.
     * @param ClientOrderRepository $repository
     * @param GetOrderItemsHandler $getOrderItemsHandler
     * @param GetOrderDeliveryHandler $getOrderDeliveryHandler
     * @param GetOrderCustomerHandler $getOrderCustomerHandler
     * @param GetOrderPriceHandler $getOrderPriceHandler
     */
    public function __construct(
        ClientOrderRepository $repository,
        GetOrderItemsHandler $getOrderItemsHandler,
        GetOrderDeliveryHandler $getOrderDeliveryHandler,
        GetOrderCustomerHandler $getOrderCustomerHandler,
        GetOrderPriceHandler $getOrderPriceHandler
    )
    {
        $this->repository = $repository;
        $this->getOrderItemsHandler = $getOrderItemsHandler;
        $this->getOrderDeliveryHandler = $getOrderDeliveryHandler;
        $this->getOrderCustomerHandler = $getOrderCustomerHandler;
        $this->getOrderPriceHandler = $getOrderPriceHandler;
        $this->baseUrl = config('uploads.resizeImagePath');
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function handle(array $requestData)
    {
        $number = getOrderNumber();
        $defaultStatus = Order::DEFAULT_STATUS_ID;
        $items = $this->getOrderItemsHandler->handle(json_decode($requestData['items'], true));
        $delivery = $this->getOrderDeliveryHandler->handle(json_decode($requestData['delivery'], true));
        $customer = $this->getOrderCustomerHandler->handle(json_decode($requestData['customer'], true));
        $price = $this->getOrderPriceHandler->handle($items, $delivery['price']);

        $orderData = [
            'number' => $number,
            'user_id' => $requestData['userId'],
            'status_id' => $defaultStatus,
            'items' => json_encode($items, true),
            'delivery' => json_encode($delivery, true),
            'customer' => json_encode($customer, true),
            'price' => $price,
            'comment' => $requestData['comment']
        ];

        return $this->repository->store($orderData);
    }

    /**
     * @param int $width
     * @param int $height
     * @param int $texturePrice
     * @param int $qty
     * @return float|int
     */
    private function getItemPrice(int $width, int $height, int $texturePrice, int $qty)
    {
        return round($width * $height / 1e6 * $texturePrice, 0) * 100 * $qty;
    }

    /**
     * @param array $items
     * @param int $deliveryPrice
     * @return int|mixed
     */
    private function getOrderPrice(array $items, int $deliveryPrice)
    {
        $itemsPrice = array_reduce($items, function ($carry, $item) {
            return $carry += $item['price'];
        }, 0);

        return $itemsPrice + $deliveryPrice;
    }
}
