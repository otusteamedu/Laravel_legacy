<?php


namespace App\Services\OrderStatus;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Base\Resource\CmsBaseResourceService;
use App\Services\OrderStatus\Repositories\OrderStatusRepository;

class OrderStatusService extends CmsBaseResourceService
{
    /**
     * OrderStatusService constructor.
     * @param OrderStatusRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        OrderStatusRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function getItemByAlias(string $alias)
    {
        return $this->repository->getItemByAlias($alias);
    }
}
