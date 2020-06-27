<?php

namespace App\Services\Courses\Handlers;

use App\Services\Courses\Repositories\CourseRepositoryInterface;

abstract class BaseHandler
{
    /** @var  CourseRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param CourseRepositoryInterface $repository
     */
    public function __construct(CourseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
