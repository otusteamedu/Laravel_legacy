<?php

namespace App\Http\Controllers\API\Auth\Base;

use App\Services\Auth\AuthService;
use App\Services\User\UserServiceCms;
use Tymon\JWTAuth\JWTAuth;


abstract class BaseLoginController extends BaseAuthController
{
    protected $userService;

    /**
     * BaseLoginController constructor.
     * @param JWTAuth $auth
     * @param AuthService $authService
     * @param UserServiceCms $userService
     */
    public function __construct(JWTAuth $auth, AuthService $authService, UserServiceCms $userService)
    {
        parent::__construct($auth, $authService);
        $this->userService = $userService;
    }
}
