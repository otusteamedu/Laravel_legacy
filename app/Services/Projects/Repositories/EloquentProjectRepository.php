<?php


namespace App\Services\Projects\Repositories;

use App\Models\Project;

class EloquentProjectRepository
{
    public function getProjects(int $paginate)
    {
        $columns = ['id', 'name'];
        $result = Project::orderBy('id', 'DESC')
            ->select($columns)
            ->paginate($paginate);
        return $result;
    }

    public function createProjects($data)
    {
       $project = new Project();
        return $project->create($data);
    }

    public function updateProjects($data)
    {
        $project = new Project();
        return $project->update($data);
    }
}
