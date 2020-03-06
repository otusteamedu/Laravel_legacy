<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Cms\User\Requests\CreateUserRequest;
use App\Http\Controllers\API\Auth\Base\BaseLoginController;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseLoginController
{
    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function register(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userService->store($request->all());

        $this->authService->createEmailVerification($user);

        return response()->json($this->authService->getMessageByRegistration($user->email), 200);
    }
}
