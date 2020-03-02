<?php

namespace App\Http\Controllers\API\Cms\Permission;

use App\Http\Controllers\API\Cms\Permission\Requests\CreatePermissionRequest;
use App\Http\Controllers\API\Cms\Permission\Requests\UpdatePermissionRequest;
use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Models\Permission;
use App\Services\Permission\CmsPermissionService;

class PermissionController extends BaseResourceController
{
    public function __construct(CmsPermissionService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreatePermissionRequest $request
     * @return Permission
     */
    public function store(CreatePermissionRequest $request): Permission
    {
        return $this->service->store($request);
    }

    /**
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @return Permission
     */
    public function update(UpdatePermissionRequest $request, int $id): Permission
    {
        return $this->service->update($request, $id);
    }
}
