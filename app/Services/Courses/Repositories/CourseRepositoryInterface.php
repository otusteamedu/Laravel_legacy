<?php

namespace App\Services\Courses\Repositories;

use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
