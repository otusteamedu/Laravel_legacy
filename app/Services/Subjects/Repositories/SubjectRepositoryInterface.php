<?php

namespace App\Services\Subjects\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface SubjectRepositoryInterface
 * @package App\Services\Subjects\Repositories
 */
interface SubjectRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
