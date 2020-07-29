<?php


namespace App\Services\Projects\Repositories;


use App\Builders\QueryBuilder;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProjectsRepositoryInterface
{
    public function find(int $id);

    public function search(int $limit = 20);

    public function getBy(QueryBuilder $builder): Collection;

    public function createFromArray(array $data): Project;

    public function updateFromArray(Project $project, array $data);

    public function delete(Project $project);
}
