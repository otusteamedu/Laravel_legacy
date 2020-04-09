<?php


namespace App\Services\Order\Repositories;


use App\Models\Order;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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
     * @param array $requestData
     * @return mixed
     */
    public function store(array $requestData)
    {
        return $this->model::create($requestData);
    }
}
