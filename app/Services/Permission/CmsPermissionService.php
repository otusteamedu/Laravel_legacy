<?php


namespace App\Services\Permission;


use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\Permission\Repositories\CmsPermissionRepository;
use App\Services\Base\Resource\CmsBaseResourceService;

class CmsPermissionService extends CmsBaseResourceService
{
    /**
     * PermissionServiceCms constructor.
     * @param CmsPermissionRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     */
    public function __construct(
        CmsPermissionRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler
    )
    {
        parent::__construct($repository, $clearCacheByTagHandler);
    }
}
