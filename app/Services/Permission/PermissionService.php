<?php


namespace App\Services\Permission;


use App\Services\Permission\Repositories\PermissionRepository;
use App\Services\Base\Resource\BaseResourceService;

class PermissionService extends BaseResourceService
{
    /**
     * PermissionService constructor.
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        parent::__construct($repository);
    }
}
