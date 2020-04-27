<?php


namespace App\Services\Order\Repositories;


use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Services\Order\Resources\ClientOrder as ClientOrderResource;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;

class ClientOrderRepository extends ClientBaseResourceRepository
{
    /**
     * ClientDeliveryRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable|User $user
     * @param int $number
     * @return mixed
     */
    public function getUserItemByNumber($user, int $number)
    {
        return $user->orders()->where('number', $number)->firstOrFail();
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function store(array $requestData)
    {
        $defaultStatus = OrderStatus::where('alias', Order::DEFAULT_STATUS)->firstOrFail();
        $order = $this->model::create($requestData);
        $order->statuses()->attach($defaultStatus->id);

        return $order;
    }

    /**
     * @param Order $order
     * @param int $status
     * @return ClientOrderResource
     */
    public function changeStatus(Order $order, int $status)
    {
        $order->statuses()->syncWithoutDetaching([$status]);

        return new ClientOrderResource($order);
    }
}
