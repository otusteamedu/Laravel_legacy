<?php


namespace App\Services\Projects\Repositories;


use App\Models\Project;

interface ProjectsRepositoryInterface
{
    public function find(int $id);

    public function search(int $limit = 20);

    public function createFromArray(array $data): Project;

    public function updateFromArray(Project $project, array $data);

    public function delete(Project $project);
}
