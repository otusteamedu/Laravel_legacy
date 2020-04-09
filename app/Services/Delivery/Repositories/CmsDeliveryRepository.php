<?php


namespace App\Services\Delivery\Repositories;

use App\Models\Delivery;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;

class CmsDeliveryRepository extends CmsBaseResourceRepository
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
