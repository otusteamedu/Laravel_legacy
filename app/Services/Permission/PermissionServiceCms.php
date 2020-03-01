<?php


namespace App\Services\Permission;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Permission\Repositories\PermissionRepositoryCms;
use App\Services\Base\Resource\CmsBaseResourceService;

class PermissionServiceCms extends CmsBaseResourceService
{
    /**
     * PermissionServiceCms constructor.
     * @param PermissionRepositoryCms $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        PermissionRepositoryCms $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
    }
}
