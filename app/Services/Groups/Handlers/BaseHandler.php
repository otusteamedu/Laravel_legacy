<?php

namespace App\Services\Groups\Handlers;

use App\Services\Groups\Repositories\GroupRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Groups\Handlers
 */
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
