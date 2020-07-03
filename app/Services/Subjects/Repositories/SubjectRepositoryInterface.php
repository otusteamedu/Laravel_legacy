<?php

namespace App\Services\Subjects\Repositories;

use Illuminate\Support\Collection;

interface SubjectRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
