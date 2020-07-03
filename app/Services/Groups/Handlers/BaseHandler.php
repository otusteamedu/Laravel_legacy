<?php

namespace App\Services\Groups\Handlers;

use App\Services\Groups\Repositories\GroupRepositoryInterface;

abstract class BaseHandler
{
    /** @var  GroupRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param GroupRepositoryInterface $repository
     */
    public function __construct(GroupRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
