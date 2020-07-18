<?php

namespace App\Services\Courses\Repositories;

use App\Models\Course;
use Illuminate\Support\Collection;

/**
 * Class EloquentCourseRepository
 * @package App\Services\Courses\Repositories
 */
class EloquentCourseRepository implements CourseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection
    {
        return Course::pluck('number', 'id');
    }
}
