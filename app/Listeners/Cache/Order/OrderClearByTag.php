<?php

namespace App\Listeners\Cache\Order;

use App\Listeners\Cache\ClearByTag;
use App\Services\Order\CmsOrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderClearByTag extends ClearByTag
{
    public function __construct(CmsOrderService $service)
    {
        parent::__construct($service);
    }
}
