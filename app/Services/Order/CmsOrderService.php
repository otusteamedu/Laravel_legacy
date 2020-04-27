<?php


namespace App\Services\Order;


use App\Mail\OrderInProcess;
use App\Models\Order;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Order\Handlers\GetMailFormatOrderHandler;
use App\Services\Order\Repositories\CmsOrderRepository;
use Illuminate\Support\Facades\Mail;

class CmsOrderService
{
    private CmsOrderRepository $repository;
    private ClearCacheByTagHandler $clearCacheByTagHandler;
    private GetMailFormatOrderHandler $getMailFormatOrderHandler;

    /**
     * CmsOrderService constructor.
     * @param CmsOrderRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param GetMailFormatOrderHandler $getMailFormatOrderHandler
     */
    public function __construct(
        CmsOrderRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        GetMailFormatOrderHandler $getMailFormatOrderHandler)
    {
        $this->repository = $repository;
        $this->clearCacheByTagHandler = $clearCacheByTagHandler;
        $this->getMailFormatOrderHandler = $getMailFormatOrderHandler;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getItems()
    {
        return $this->repository->getItems();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->repository->getItem($id);
    }

    /**
     * @param int $id
     * @return Resources\CmsOrder
     */
    public function getItemDetails(int $id)
    {
        return $this->repository->getItemDetails($id);
    }

    /**
     * @param Order $order
     */
    public function sendMailByCreate(Order $order)
    {
        $orderData = $this->getMailFormatOrderHandler->handle($order);
        $email = $orderData['customer']['email'];

        Mail::to($email)
            ->queue(new OrderInProcess($orderData));
    }

    /**
     * @param int $id
     * @param array $requestData
     * @return Resources\CmsOrder|Resources\CmsOrderFromList
     */
    public function changeStatus(int $id, array $requestData)
    {
        $order = $this->repository->getItem($id);

        return $this->repository->changeStatus($order, $requestData['status'], $requestData['list']);
    }
}
