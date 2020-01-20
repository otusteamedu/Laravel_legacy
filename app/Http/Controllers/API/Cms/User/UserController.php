<?php

namespace App\Http\Controllers\API\Cms\User;

use App\Http\Controllers\API\Cms\Base\BaseResourceController;
use App\Http\Controllers\Api\Cms\User\Requests\CreateUserRequest;
use App\Http\Controllers\Api\Cms\User\Requests\UpdateUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends BaseResourceController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request));
    }

    /**
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        return response()->json($this->service->update($request, $id));
    }
}
