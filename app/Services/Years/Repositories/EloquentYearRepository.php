<?php

namespace App\Services\Years\Repositories;

use App\Models\EducationYear;
use Illuminate\Support\Collection;

/**
 * Class EloquentYearRepository
 * @package App\Services\Years\Repositories
 */
class EloquentYearRepository implements YearRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection
    {
        return EducationYear::all()->pluck('period', 'id');
    }
}
