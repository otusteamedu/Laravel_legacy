<?php

namespace App\Http\Controllers\API\Cms\User;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\API\Cms\User\Requests\CreateUserRequest;
use App\Http\Controllers\API\Cms\User\Requests\UpdateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends BaseResourceController
{
    /**
     * UserController constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
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
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($id, $request->all()));
    }
}
