<?php

namespace App\Services\Users\Handlers;

use App\Services\Users\Repositories\UserRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Users\Handlers
 */
abstract class BaseHandler
{
    /** @var  UserRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
