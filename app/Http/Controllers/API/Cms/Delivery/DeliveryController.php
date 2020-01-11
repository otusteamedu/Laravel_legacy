<?php

namespace App\Http\Controllers\API\Cms\Delivery;


use App\Http\Controllers\Api\Cms\Delivery\Requests\CreateDeliveryRequest;
use App\Http\Controllers\Api\Cms\Delivery\Requests\UpdateDeliveryRequest;
use App\Http\Controllers\API\Cms\Resource\ResourceController;
use App\Models\Delivery;
use App\Services\Delivery\DeliveryService;

class DeliveryController extends ResourceController
{
    public function __construct(DeliveryService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateDeliveryRequest $request
     * @return Delivery
     */
    public function store(CreateDeliveryRequest $request): Delivery
    {
        return $this->service->store($request);
    }

    /**
     * @param UpdateDeliveryRequest $request
     * @param int $id
     * @return Delivery
     */
    public function update(UpdateDeliveryRequest $request, int $id): Delivery
    {
        return $this->service->update($request, $id);
    }
}
