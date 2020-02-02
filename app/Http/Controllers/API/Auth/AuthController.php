<?php

namespace App\Http\Controllers\API\Auth;


use App\Http\Controllers\API\Auth\Base\BaseAuthController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends BaseAuthController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json($this->authService->index($request));
    }

    public function logout()
    {
        $this->authService->logout();
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyUser(string $token)
    {
        return $this->authService->verifyUser($token);
    }
}
