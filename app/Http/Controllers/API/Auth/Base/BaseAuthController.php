<?php

namespace App\Http\Controllers\API\Auth\Base;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Tymon\JWTAuth\JWTAuth;


abstract class BaseAuthController extends Controller
{
    protected JWTAuth $auth;

    protected AuthService $authService;

    /**
     * BaseAuthController constructor.
     * @param JWTAuth $auth
     * @param AuthService $authService
     */
    public function __construct(JWTAuth $auth, AuthService $authService)
    {
        $this->auth = $auth;
        $this->authService = $authService;
    }
}
