<?php


namespace App\Services\Order\Handlers;


use App\Models\Order;
use App\Services\Order\Repositories\ClientOrderRepository;
use Illuminate\Support\Arr;

class GetMailFormatOrderHandler
{
    private string $baseUrl;

    private ClientOrderRepository $repository;

    /**
     * CreateOrderHandler constructor.
     * @param ClientOrderRepository $repository
     */
    public function __construct(ClientOrderRepository $repository)
    {
        $this->repository = $repository;
        $this->baseUrl = config('uploads.resizeImagePath');
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function handle(array $requestData)
    {
        $number = getOrderNumber();
        $defaultStatus = Order::DEFAULT_STATUS_ID;

        return $this->repository->store(Arr::collapse([$requestData, [
            'number' => $number,
            'status_id' => $defaultStatus
        ]]));
    }
}
