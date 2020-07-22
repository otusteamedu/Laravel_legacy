<?php


namespace App\Services\ProjectTasks\Repositories;


use App\Models\ProjectTask;

interface ProjectTasksRepositoryInterface
{
    public function find(int $id);

    public function search(int $limit = 20);

    public function createFromArray(array $data): ProjectTask;

    public function updateFromArray(ProjectTask $project, array $data);

    public function delete(ProjectTask $project);
}
