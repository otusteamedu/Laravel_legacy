<?php

namespace App\Http\Controllers\API\Client\Delivery;


use App\Http\Controllers\API\Client\Base\BaseResourceController;
use App\Services\Delivery\ClientDeliveryService;

class DeliveryController extends BaseResourceController
{
    /**
     * ClientCategoryController constructor.
     * @param ClientDeliveryService $service
     */
    public function __construct(ClientDeliveryService $service)
    {
        parent::__construct($service);
    }
}
