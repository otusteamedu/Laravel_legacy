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

    public function createProject(array $data) : Project
    {
        $project = new Project();
        return $project->create($data);
    }

    public function updateProject(Project $project, array $data)
    {
        return $project->update($data);
    }

    public function delProject(int $id)
    {
        return Project::destroy($id);
    }
}
