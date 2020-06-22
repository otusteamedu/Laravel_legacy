<?php

namespace App\Services\Years\Repositories;

use Illuminate\Support\Collection;

interface YearRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection;
}
