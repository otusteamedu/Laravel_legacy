<?php


namespace App\Services\Delivery;


use App\Services\Delivery\Repositories\DeliveryRepository;
use App\Services\Resource\ResourceService;

class DeliveryService extends ResourceService
{
    /**
     * DeliveryService constructor.
     * @param DeliveryRepository $repository
     */
    public function __construct(DeliveryRepository $repository)
    {
        parent::__construct($repository);
    }
}
