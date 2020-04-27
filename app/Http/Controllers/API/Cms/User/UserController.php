<?php

namespace App\Http\Controllers\API\Cms\User;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\User\Requests\CreateRequest;
use App\Http\Controllers\API\Cms\User\Requests\UpdateRequest;
use App\Services\User\CmsUserService;
use Illuminate\Http\JsonResponse;

class UserController extends BaseResourceController
{
    /**
     * UserController constructor.
     * @param CmsUserService $service
     */
    public function __construct(CmsUserService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->service->getItemWithRole($id));
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }
}
