<?php

namespace App\Services\Projects\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class EloquentProjectRepository implements ProjectRepositoryInterface
{
    public function find(int $id)
    {
        return Project::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Project::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Project
    {
        $project = new Project();
        $project->create($data);
        return $project;
    }

    public function updateFromArray(Project $project, array $data)
    {
        $project->update($data);
        return $project;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
