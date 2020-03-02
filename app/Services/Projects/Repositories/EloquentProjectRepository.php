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
        $id = Project::findOrFail($id);
        return Project::destroy($id);
    }

    public function getAllProjects()
    {
        return Project::pluck('name', 'id');
    }

    public function findProject($id)
    {
        $columns = ['id', 'name', 'description'];
        $result = Project::findOrFail($id);
        return $result;
    }
}
