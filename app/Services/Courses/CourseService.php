<?php

namespace App\Services\Courses;

use App\Services\Courses\Repositories\CourseRepositoryInterface;
use App\Services\Courses\Wrappers\CoursesByHrefWrapper;
use App\Services\Interfaces\CacheService;
use App\Services\Traits\CacheClearable;
use Illuminate\Support\Collection;

/**
 * Class CourseService
 * @package App\Services\Courses
 */
class CourseService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'COURSE';

    /** @var  CourseRepositoryInterface*/
    protected $repository;
    /** @var CoursesByHrefWrapper  */
    protected $coursesByHrefWrapper;

    /**
     * CourseService constructor.
     * @param CourseRepositoryInterface $repository
     * @param CoursesByHrefWrapper $coursesByHrefWrapper
     */
    public function __construct(
        CourseRepositoryInterface $repository,
        CoursesByHrefWrapper $coursesByHrefWrapper
    ) {
        $this->repository = $repository;
        $this->coursesByHrefWrapper = $coursesByHrefWrapper;
    }

    public function cacheWarm(): void
    {
        $this->courseSelectList();
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
     * Получаем коллекцию вида {id => <a href="courses/id">number</a>}
     * @param Collection $courses
     * @return Collection
     */
    public function wrapCoursesByHref(Collection $courses): Collection
    {
        return $this->coursesByHrefWrapper->wrap($courses);
    }
}
