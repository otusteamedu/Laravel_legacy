<?php


namespace App\Services\Projects\Repositories;


use App\Models\Project;

class EloquentProjectsRepository implements ProjectsRepositoryInterface
{

    public function find(int $id)
    {
        return Project::whereId($id)->first();
    }

    public function search(int $limit = 20)
    {
        return Project::paginate($limit);
    }

    public function createFromArray(array $data): Project
    {
        $project = new Project();
        $project->create($data);
        return $project;
    }

    public function updateFromArray(Project $project, array $data)
    {
        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $project->update($data);

        return $project;
    }

    public function delete(Project $project)
    {
        return $project->delete();
    }
}
