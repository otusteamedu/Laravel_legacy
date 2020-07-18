<?php

namespace App\Services\Years\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface YearRepositoryInterface
 * @package App\Services\Years\Repositories
 */
interface YearRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
