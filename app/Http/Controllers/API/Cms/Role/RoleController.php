<?php

namespace App\Http\Controllers\API\Cms\Role;


use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\Role\Requests\CreateRoleRequest;
use App\Http\Controllers\API\Cms\Role\Requests\UpdateRoleRequest;
use App\Services\Role\CmsRoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends BaseResourceController
{
    /**
     * RoleController constructor.
     * @param CmsRoleService $service
     */
    public function __construct(CmsRoleService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getItemWithPermissions(int $id): JsonResponse
    {
        return response()->json($this->service->getItemWithPermissions($id));
    }

    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }

    /**
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }
}
