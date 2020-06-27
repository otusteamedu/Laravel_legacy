<?php

namespace App\Services\Courses;

use App\Services\Courses\Handlers\WrapCoursesByHrefHandler;
use App\Services\Courses\Repositories\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class CourseService
{
    /** @var  CourseRepositoryInterface*/
    protected $repository;
    /** @var WrapCoursesByHrefHandler  */
    protected $wrapCoursesByHrefHandler;

    /**
     * CourseService constructor.
     * @param CourseRepositoryInterface $repository
     * @param WrapCoursesByHrefHandler $wrapCoursesByHrefHandler
     */
    public function __construct(
        CourseRepositoryInterface $repository,
        WrapCoursesByHrefHandler $wrapCoursesByHrefHandler
    ) {
        $this->repository = $repository;
        $this->wrapCoursesByHrefHandler = $wrapCoursesByHrefHandler;
    }

    /**
     * Получить массив курсов ['id' => 'number']
     * @return array
     */
    public function courseSelectList(): array
    {
        return $this->repository->selectList()->toArray();
    }

    /**
     * Оборачивает эл-ты коллекция в тег <a></a>
     * Получаем коллекцию вида {id => <a href="courses/id">id</a>}
     * @param Collection $courses
     * @return Collection
     */
    public function wrapCoursesByHref(Collection $courses): Collection
    {
        return $this->wrapCoursesByHrefHandler->handle($courses);
    }
}
