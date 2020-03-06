<?php


namespace App\Services\Base\Auth;


use App\Services\User\Repositories\UserRepository;
use Tymon\JWTAuth\JWTAuth;

abstract class BaseAuthService
{
    protected JWTAuth $auth;

    protected UserRepository $repository;

    /**
     * BaseAuthService constructor.
     * @param JWTAuth $auth
     * @param UserRepository $repository
     */
    public function __construct(JWTAuth $auth, UserRepository $repository)
    {
        $this->auth = $auth;
        $this->repository = $repository;
    }
}
