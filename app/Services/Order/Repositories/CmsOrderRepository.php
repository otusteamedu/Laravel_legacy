<?php


namespace App\Services\Order\Repositories;

use App\Models\Order;
use App\Services\Order\Resources\CmsOrder as OrderResource;
use App\Services\Order\Resources\CmsOrderFromList as OrderFromListResource;

class CmsOrderRepository
{
    private Order $model;
    /**
     * DeliveryRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getItems()
    {
        return OrderFromListResource::collection($this->model::orderBy('id', 'desc')->get());
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param int $id
     * @return OrderResource
     */
    public function getItemDetails(int $id)
    {
        return new OrderResource($this->model::findOrFail($id));
    }

    /**
     * @param Order $order
     * @param int $status
     * @param bool $isList
     * @return OrderResource|OrderFromListResource
     */
    public function changeStatus(Order $order, int $status, bool $isList)
    {
        $order->statuses()->syncWithoutDetaching([$status]);

        return $isList
            ? new OrderFromListResource($order)
            : new OrderResource($order);
    }
}
