<?php


namespace App\Services\Projects\Repositories;


use App\Builders\QueryBuilder;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

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

    public function getBy(QueryBuilder $builder): Collection
    {
        $builder = $builder->build(Project::query());

        return $builder->get();
    }

    public function createFromArray(array $data): Project
    {
        $project = (new Project())->create($data);

        return $project;
    }

    public function updateFromArray(Project $project, array $data)
    {
        $project->update($data);

        return $project;
    }

    public function delete(Project $project)
    {
        return $project->delete();
    }
}
