<?php


namespace App\Services;

use App\Base\Service\BaseService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\Interfaces\Adapters\IProduct;
use App\Repositories\Interfaces\IOrderRepository;
use App\Services\Exceptions\OrderException;
use App\Services\Exceptions\TicketException;
use App\Services\Interfaces\IOrderItemService;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IUserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class OrderService extends BaseService implements IOrderService
{
    private $orderItemService;
    private $oneSession;
    private $userService;

    public function __construct(
        IOrderItemService $itemService,
        OneSession $oneSession,
        IUserService $userService)
    {
        parent::__construct();
        $this->orderItemService = $itemService;
        $this->oneSession = $oneSession;
        $this->userService = $userService;
    }

    public function createOrder(): Order {
        // TODO: Implement createOrder() method.
    }

    public function destroyOrder(Order $order) {
        // TODO: Implement destroyOrder() method.
    }

    public function getOrderSession(): Order {
        /** @var IOrderRepository $repository */
        $repository = $this->getRepository();
        $session_id = $this->oneSession->getSessionId();
        $order = $repository->getOrderSession($session_id);

        if($order)
            return $order;

        $owner = $this->userService->currentUser();
        $data = [
            'session_id' => $session_id,
            'count' => 0,
            'total' => 0
        ];
        if($owner)
            $data['owner_id'] = $owner->id;
        /** @var Order $order */
        $order = $repository->createFromArray($data);

        return $order;
    }
    public function getUserOrder(User $user, string $order_number): ?Order {
        /** @var IOrderRepository $repository */
        $repository = $this->getRepository();
        return $repository->getUserOrder($user, $order_number);
    }
    /**
     * @param IProduct $product
     * @return OrderItem
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addSessProduct(IProduct $product): OrderItem {
        $order = $this->getOrderSession();
        return $this->addProduct($order, $product);
    }
    /**
     * @param Order $order
     * @param IProduct $product
     * @return OrderItem
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addProduct(Order $order, IProduct $product): OrderItem {
        $item = $this->orderItemService->addProduct($order, $product);
        $this->updateOrderSession();
        return $item;
    }

    public function addProducts(Order $order, array $products): array
    {
        // TODO: Implement addProducts() method.
    }

    public function getOrderItems(Order $order): array {
        return $this->orderItemService->getOrderItems($order)->toArray();
    }

    public function getOrderItem(Order $order, int $item_id): OrderItem {
        return $this->orderItemService->getOrderItem($order, $item_id);
    }

    public function getProducts(Order $order): array
    {
        $result = [];
        $items = $this->getOrderItems($order);
        /** @var OrderItem $item */
        foreach ($items as $item)
            $result[] = $this->orderItemService->getProduct($item);
        return $result;
    }
    /**
     * @return Order
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updateOrderSession(): Order
    {
        /** @var IOrderRepository $repository */
        $repository = $this->getRepository();

        $order = $this->getOrderSession();
        $items = $this->orderItemService->getOrderItems($order);

        $count = 0;
        $total = 0;
        /** @var OrderItem $item */
        foreach ($items as $item) {
            $this->orderItemService->UpdateItem($item);
            $count++;
            $total += $item->price;
        }
        /** @var Order $order */
        $order = $repository->updateFromArray($order, [
            'count' => $count,
            'total' => $total,
        ]);
        return $order;
    }

    private function validateContactData(array $contactData) {
        \Illuminate\Support\Facades\Validator::make($contactData, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
        ], [
            'name.required' => __('errors.required', ['field' => __('public.order.name')]),
            'email.required' => __('errors.required', ['field' => __('public.order.email')]),
            'phone.required' => __('errors.required', ['field' => __('public.order.phone')])
        ])->validate();
    }
    private function validateConfirmOrderSession(array $contactData) {
        $this->validateContactData($contactData);

        $ex = new OrderException;
        if(!$this->userService->currentUser())
            $ex->add(__('errors.orders.place_access'));

        $order = $this->getOrderSession();
        $items = $this->orderItemService->getOrderItems($order);
        if($order->total <= 0)
            $ex->add(__('errors.orders.order_empty'));
        /** @var OrderItem $item */
        foreach ($items as $item) {
            if(!$item->available)
                $ex->add(__('errors.orders.item_not_available', ['name' => $item->name]));
        }
        $ex->assert();
    }

    private function generateOrderNumber(Order $order): string {
        $now = Carbon::now();
        return sprintf("%s-%04d", $now->format("dmy-Hi"), $order->id);
    }
    /**
     * @param array $contactData
     * @return Order
     * @throws \App\Base\WrongNamespaceException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function confirmOrderSession(array $contactData): Order
    {
        $this->updateOrderSession();

        $this->validateConfirmOrderSession($contactData);

        /** @var IOrderRepository $repository */
        $repository = $this->getRepository();
        $order = $this->getOrderSession();
        $buyer = $this->userService->currentUser();
        $data = [
            'buyer_id' => $buyer->id,
            'session_id' => '',
            'number' => $this->generateOrderNumber($order),
            'ordered_at' => Carbon::now(),
            'name' => $contactData['name'],
            'phone' => $contactData['phone'],
            'email' => $contactData['email'],
            'status' => 'confirmed'
        ];

        /** @var Order $order */
        $order = $repository->updateFromArray($order, $data);
        return $order;
    }

    public function placeOrder(User $buyer, array $products, array $contactData): Order
    {
        return new Order();
    }

    public function payOrder(Order $order): Order
    {
        return $order;
    }

    public function summaryOrderSession(): array
    {
        $order = $this->getOrderSession();
        return [
            'count' => $order->count,
            'total' => $order->total
        ];
    }

    public function clearOrderSession(): Order
    {
        $order = $this->getOrderSession();
        $items = $this->getOrderItems($order);
        /** @var OrderItem $item */
        foreach ($items as $item) {
            $this->orderItemService->removeItem($order, $item);
        }
    }
    public function removeProduct(Order $order, IProduct $product): Order {
        $this->orderItemService->removeProduct($order, $product);
        return $order;
    }

    public function removeItem(Order $order, OrderItem $item): Order {
        $this->orderItemService->removeItem($order, $item);
        return $order;
    }

    public function removeSessProduct(IProduct $product): Order
    {
        $order = $this->getOrderSession();
        $this->orderItemService->removeProduct($order, $product);
        return $order;
    }
}
