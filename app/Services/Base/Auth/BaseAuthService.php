<?php


namespace App\Services\Base\Auth;


use App\Services\User\Repositories\UserRepositoryCms;
use Tymon\JWTAuth\JWTAuth;

abstract class BaseAuthService
{
    /**
     * @var JWTAuth
     */
    protected $auth;

    /**
     * @var UserRepositoryCms
     */
    protected $repository;

    /**
     * BaseAuthService constructor.
     * @param JWTAuth $auth
     * @param UserRepositoryCms $repository
     */
    public function __construct(JWTAuth $auth, UserRepositoryCms $repository)
    {
        $this->auth = $auth;
        $this->repository = $repository;
    }
}
