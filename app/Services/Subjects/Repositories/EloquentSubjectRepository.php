<?php

namespace App\Services\Subjects\Repositories;

use App\Models\Subject;
use Illuminate\Support\Collection;

/**
 * Class EloquentSubjectRepository
 * @package App\Services\Subjects\Repositories
 */
class EloquentSubjectRepository implements SubjectRepositoryInterface
{
    /**
     * @return Collection
     */
    public function selectList(): Collection
    {
        return Subject::orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
