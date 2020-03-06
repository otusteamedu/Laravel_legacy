<?php

namespace App\Http\Controllers\API\Auth\Base;


use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Tymon\JWTAuth\JWTAuth;

abstract class BaseLoginController extends BaseAuthController
{
    protected UserService $userService;

    /**
     * BaseLoginController constructor.
     * @param JWTAuth $auth
     * @param AuthService $authService
     * @param UserService $userService
     */
    public function __construct(JWTAuth $auth, AuthService $authService, UserService $userService)
    {
        parent::__construct($auth, $authService);
        $this->userService = $userService;
    }
}
