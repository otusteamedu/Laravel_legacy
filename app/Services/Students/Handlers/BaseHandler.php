<?php

namespace App\Services\Students\Handlers;

use App\Services\Students\Repositories\StudentRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Students\Handlers
 */
abstract class BaseHandler
{
    /** @var  StudentRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param StudentRepositoryInterface $repository
     */
    public function __construct(StudentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
