<?php


namespace App\Services\Permission\Repositories;

use App\Models\Permission;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;

class PermissionRepository extends BaseResourceRepository
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
