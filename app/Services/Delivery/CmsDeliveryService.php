<?php


namespace App\Services\Delivery;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Delivery\Repositories\DeliveryRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;

class CmsDeliveryService extends CmsBaseResourceService
{
    /**
     * CmsDeliveryService constructor.
     * @param DeliveryRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        DeliveryRepositoryCms $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
    }
}
