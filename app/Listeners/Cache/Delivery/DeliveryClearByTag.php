<?php

namespace App\Listeners\Cache\Delivery;

use App\Listeners\Cache\ClearByTag;
use App\Services\Delivery\CmsDeliveryService;

class DeliveryClearByTag extends ClearByTag
{
    public function __construct(CmsDeliveryService $service)
    {
        parent::__construct($service);
    }
}
