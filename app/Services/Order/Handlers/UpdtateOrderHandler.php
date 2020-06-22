<?php

namespace App\Services\Order\Handlers;

use App\Models\Order;
use App\Services\OrderStatus\Checkers\IdExistChecker as OrderIdExistChecker;
use App\Services\Product\Checkers\IdExistChecker as ProductIdExistChecker;
use App\Services\Order\Checkers\ProductsChecker;
use App\Services\Order\Repositories\OrderRepositoryInterface;

class UpdateOrderHandler
{
    protected $orderRepository;
    protected $orderStatusIdExistChecker;
    protected $productIdExistChecker;
    protected $productsChecker;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderIdExistChecker $orderStatusIdExistChecker,
        ProductIdExistChecker $productIdExistChecker,
        ProductsChecker $productsChecker
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderStatusIdExistChecker = $orderStatusIdExistChecker;
        $this->productIdExistChecker = $productIdExistChecker;
        $this->productsChecker = $productsChecker;
    }

    public function handle(Order $order, array $data): Order
    {
        if (isset($data['status_id'])) {
            $this->orderStatusIdExistChecker->check($data['status_id'], 'status_id');
        }

        if (isset($data['products'])) {
            $this->productsChecker->check($data['products']);
        }

        return $this->orderRepository->updateFromArray($order, $data);
    }
}
