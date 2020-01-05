<?php


namespace App\Services;


use App\Base\Service\BaseService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interfaces\Adapters\IProduct;
use App\Repositories\Interfaces\IOrderItemRepository;
use App\Services\Exceptions\OrderException;
use App\Services\Interfaces\IOrderItemService;
use Illuminate\Database\Eloquent\Collection;
use ReflectionClass;

class OrderItemService extends BaseService implements IOrderItemService {
    /**
     * @param OrderItem $item
     * @return bool
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function UpdateItem(OrderItem $item): bool
    {
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        $product = $this->getProduct($item);
        if(!$product)
            return false;

        $repository->updateFromArray($item, [
            'name' => $product->GetName(),
            'description' => $product->GetDescription(),
            'price' => $product->GetPrice(),
            'available' => $product->GetAvailable()
        ]);

        return true;
    }

    /**
     * @param Order $order
     * @param IProduct $product
     */
    private function validateAddProduct(Order $order, IProduct $product) {
        $e = new OrderException;
        if(!$product->GetAvailable())
            $e->add(__('errors.orders.addproduct', ['name' => $product->GetName()]));
        if(!$product->validateOrderAdd($order))
            $e->add(__('errors.orders.addproduct', ['name' => $product->GetName()]));

        $e->assert();
    }
    /**
     * @param Order $order
     * @param IProduct $product
     * @return OrderItem
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addProduct(Order $order, IProduct $product): OrderItem {
        $this->validateAddProduct($order, $product);
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();

        $item = $repository->findByProductId($order, $product->GetId());
        if($item)
            return $item;
        /** @var OrderItem $item */
        $item = $repository->createFromArray([
            'order_id' => $order->id,
            'product_id' => $product->GetId(),
            'product_class' => get_class($product)
        ]);

        $this->UpdateItem($item);

        return $item;
    }

    private function validateRemoveItem(Order $order, OrderItem $item) {
        if($item->order_id != $order->id)
            throw new OrderException(__('errors.orders.itemNo', ['itemid' => $item->id, 'orderid' => $order->id]));
    }

    private function validateRemoveProduct(Order $order, IProduct $product) {
        if(!$this->IsProductInOrder($order, $product))
            throw new OrderException(__('errors.orders.productNo', ['name' => $product->GetName()]));
    }
    /**
     * @param Order $order
     * @param OrderItem $item
     * @return OrderItem
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function removeItem(Order $order, OrderItem $item): OrderItem {
        $this->validateRemoveItem($order, $item);

        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        $repository->remove($item);

        return $item;
    }
    /**
     * @param Order $order
     * @param IProduct $product
     * @return OrderItem
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function removeProduct(Order $order, IProduct $product): OrderItem {
        $this->validateRemoveProduct($order, $product);
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        $item = $repository->findByProductId($order, $product->GetId());

        return $this->removeItem($order, $item);
    }
    public function getProduct(OrderItem $item): ?IProduct
    {
        $productClass = $item->product_class;
        $product_id = $item->product_id;
        try {
            $oReflectionClass = new ReflectionClass($productClass);
            return $oReflectionClass->getMethod('getById')->invoke(null, $product_id);
        } catch (\Exception $e) {
        }

        return null;
    }
    public function IsProductInOrder(Order $order, IProduct $product): bool {
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        return $repository->findByProductId($order, $product->GetId()) != null;
    }
    public function getOrderItems(Order $order): Collection
    {
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        return $repository->getOrderItems($order);
    }

    public function getOrderItem(Order $order , int $item_id): OrderItem
    {
        /** @var IOrderItemRepository $repository */
        $repository = $this->getRepository();
        return $repository->findByItemId($order, $item_id);
    }
}
