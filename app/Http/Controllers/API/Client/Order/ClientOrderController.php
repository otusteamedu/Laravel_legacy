<?php

namespace App\Http\Controllers\API\Client\Order;


use App\Http\Controllers\API\Client\Base\ClientBaseResourceController;
use App\Http\Controllers\API\Client\Order\Requests\CreateOrderRequest;
use App\Services\Order\ClientOrderService;

class ClientOrderController extends ClientBaseResourceController
{
    /**
     * ClientOrderController constructor.
     * @param ClientOrderService $service
     */
    public function __construct(ClientOrderService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateOrderRequest $request
     * @return mixed
     */
    public function store(CreateOrderRequest $request)
    {
        return $this->service->store($request->all());
    }
}
