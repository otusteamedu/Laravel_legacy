<?php


namespace App\Services\Permission;


use App\Services\Permission\Repositories\PermissionRepository;
use App\Services\Resource\ResourceService;

class PermissionService extends ResourceService
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
