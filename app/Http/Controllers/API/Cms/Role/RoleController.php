<?php

namespace App\Http\Controllers\API\Cms\Role;


use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\Role\Requests\CreateRoleRequest;
use App\Http\Controllers\API\Cms\Role\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Services\Role\RoleServiceCms;

class RoleController extends BaseResourceController
{
    /**
     * RoleController constructor.
     * @param RoleServiceCms $service
     */
    public function __construct(RoleServiceCms $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateRoleRequest $request
     * @return Role
     */
    public function store(CreateRoleRequest $request): Role
    {
        return $this->service->store($request);
    }

    /**
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return Role
     */
    public function update(UpdateRoleRequest $request, int $id): Role
    {
        return $this->service->update($request, $id);
    }
}
