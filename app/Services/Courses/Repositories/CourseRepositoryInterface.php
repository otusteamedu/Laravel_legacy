<?php

namespace App\Services\Courses\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface CourseRepositoryInterface
 * @package App\Services\Courses\Repositories
 */
interface CourseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
