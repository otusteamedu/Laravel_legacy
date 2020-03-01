<?php


namespace App\Services\Delivery;


use App\Services\Delivery\Repositories\DeliveryRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;

class DeliveryServiceCms extends CmsBaseResourceService
{
    /**
     * DeliveryService constructor.
     * @param DeliveryRepositoryCms $repository
     */
    public function __construct(DeliveryRepositoryCms $repository)
    {
        parent::__construct($repository);
    }
}
