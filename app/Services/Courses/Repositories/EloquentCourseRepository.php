<?php

namespace App\Services\Courses\Repositories;

use App\Models\Course;
use Illuminate\Support\Collection;

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
