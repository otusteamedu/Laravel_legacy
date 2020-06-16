<?php


namespace App\Services\Projects\Repositories;


use App\Models\Project;

class EloquentProjectsRepository implements ProjectsRepositoryInterface
{

    public function find(int $id)
    {
        return Project::remember(Project::CACHE_TTL)->whereId($id)->first();
    }

    public function search(int $limit = 20)
    {
        return Project::remember(Project::CACHE_TTL)->paginate($limit);
    }

    public function createFromArray(array $data): Project
    {
        $project = new Project();
        $project->create($data);

        Project::flushCache();

        return $project;
    }

    public function updateFromArray(Project $project, array $data)
    {
        $project->update($data);

        Project::flushCache();

        return $project;
    }

    public function delete(Project $project)
    {
        $res = $project->delete();

        Project::flushCache();

        return $res;
    }
}
