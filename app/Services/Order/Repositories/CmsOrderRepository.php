<?php


namespace App\Services\Order\Repositories;

use App\Models\Order;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

class CmsOrderRepository extends CmsBaseResourceRepository
{
    /**
     * DeliveryRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
}
