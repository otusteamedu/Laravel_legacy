<?php

namespace App\Listeners\Mail\Order;

use App\Events\Models\Order\OrderSaved;
use App\Services\Order\CmsOrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCreated implements ShouldQueue
{
    use InteractsWithQueue;

    private CmsOrderService $orderSevice;

    /**
     * SendCreated constructor.
     * @param CmsOrderService $orderSevice
     */
    public function __construct(CmsOrderService $orderSevice)
    {
        $this->orderSevice = $orderSevice;
    }

    /**
     * Handle the event.
     *
     * @param  OrderSaved $event
     * @return void
     */
    public function handle(OrderSaved $event)
    {
        $this->orderSevice->sendMailByCreate($event->order);
    }
}
