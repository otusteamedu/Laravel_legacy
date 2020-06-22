<?php

namespace App\Services\Courses;

use App\Services\Courses\Repositories\CourseRepositoryInterface;

class CourseService
{
    /** @var  CourseRepositoryInterface*/
    protected $repository;

    /**
     * CourseService constructor.
     * @param CourseRepositoryInterface $repository
     */
    public function __construct(CourseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function courseSelectList(): array
    {
        return $this->repository->selectList()->toArray();
    }
}
