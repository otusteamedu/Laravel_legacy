<?php

namespace App\Http\Controllers\API\Cms\SettingGroup;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\SettingGroup\Requests\CreateSettingGroupRequest;
use App\Http\Controllers\API\Cms\SettingGroup\Requests\UpdateSettingGroupRequest;
use App\Services\SettingGroup\CmsSettingGroupService;
use Illuminate\Http\JsonResponse;

class SettingGroupController extends BaseResourceController
{
    /**
     * SettingGroupController constructor.
     * @param CmsSettingGroupService $service
     */
    public function __construct(CmsSettingGroupService $service)
    {
        parent::__construct($service);
    }

    /**
     * @return JsonResponse
     */
    public function getItemsWithSettings(): JsonResponse
    {
        return response()->json($this->service->getItemsWithSettings());
    }

    /**
     * @param CreateSettingGroupRequest $request
     * @return JsonResponse
     */
    public function store(CreateSettingGroupRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }

    /**
     * @param UpdateSettingGroupRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSettingGroupRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }
}
