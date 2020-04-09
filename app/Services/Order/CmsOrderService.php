<?php


namespace App\Services\Order;


use App\Mail\OrderInProcess;
use App\Models\Order;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Cache\Tag;
use App\Services\Order\Repositories\CmsOrderRepository;
use App\Services\Base\Resource\CmsBaseResourceService;

class CmsOrderService extends CmsBaseResourceService
{
    /**
     * CmsDeliveryService constructor.
     * @param CmsOrderRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        CmsOrderRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
        $this->cacheTag = Tag::ORDERS_TAG;
    }

    public function sendMailByCreate(Order $order)
    {
//        $email = json_decode($event->order->customer, true)['email'];
//
//        Mail::to($email)
//            ->queue(new OrderInProcess($event->order));
    }
}
