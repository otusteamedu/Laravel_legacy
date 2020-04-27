<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Auth\Base\BaseLoginController;
use App\Http\Controllers\API\Client\User\Requests\CreateRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseLoginController
{
    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function register(CreateRequest $request): JsonResponse
    {
        $user = $this->userService->store($request->all());
        $this->authService->createEmailConfirmation($user, $user->email);

        return response()->json($this->authService->getMessageByEmailConfirmation($user->email));
    }
}
