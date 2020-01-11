<?php


namespace App\Services\Permission\Repositories;

use App\Models\Permission;
use App\Services\Resource\Repositories\ResourceRepository;

class PermissionRepository extends ResourceRepository
{
    /**
     * PermissionRepository constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
