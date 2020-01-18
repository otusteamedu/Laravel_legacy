<?php


namespace App\Services\Delivery;


use App\Services\Delivery\Repositories\DeliveryRepository;
use App\Services\Base\Resource\BaseResourceService;

class DeliveryService extends BaseResourceService
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
