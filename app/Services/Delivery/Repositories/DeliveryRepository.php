<?php


namespace App\Services\Delivery\Repositories;

use App\Models\Delivery;
use App\Services\Resource\Repositories\ResourceRepository;

class DeliveryRepository extends ResourceRepository
{
    /**
     * DeliveryRepository constructor.
     * @param Delivery $model
     */
    public function __construct(Delivery $model)
    {
        $this->model = $model;
    }
}
