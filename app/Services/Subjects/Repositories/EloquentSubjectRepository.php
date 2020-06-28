<?php

namespace App\Services\Subjects\Repositories;

use App\Models\Subject;
use Illuminate\Support\Collection;

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
