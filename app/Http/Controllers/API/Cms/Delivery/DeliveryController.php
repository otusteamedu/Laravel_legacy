<?php

namespace App\Http\Controllers\API\Cms\Delivery;


use App\Http\Controllers\API\Cms\Delivery\Requests\CreateDeliveryRequest;
use App\Http\Controllers\API\Cms\Delivery\Requests\UpdateDeliveryRequest;
use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Models\Delivery;
use App\Services\Delivery\CmsDeliveryService;

class DeliveryController extends BaseResourceController
{
    /**
     * DeliveryController constructor.
     * @param CmsDeliveryService $service
     */
    public function __construct(CmsDeliveryService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateDeliveryRequest $request
     * @return Delivery
     */
    public function store(CreateDeliveryRequest $request): Delivery
    {
        return $this->service->store($request->all());
    }

    /**
     * @param UpdateDeliveryRequest $request
     * @param int $id
     * @return Delivery
     */
    public function update(UpdateDeliveryRequest $request, int $id): Delivery
    {
        return $this->service->update($id, $request->all());
    }
}
