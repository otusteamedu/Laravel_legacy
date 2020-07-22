<?php


namespace App\Services\ProjectTasks\Repositories;


use App\Models\ProjectTask;

class EloquentProjectTasksRepository implements ProjectTasksRepositoryInterface
{

    public function find(int $id)
    {
        return ProjectTask::whereId($id)->first();
    }

    public function search(int $limit = 20)
    {
        return ProjectTask::paginate($limit);
    }

    public function createFromArray(array $data): ProjectTask
    {
        $project = new ProjectTask();
        $project->create($data);

        return $project;
    }

    public function updateFromArray(ProjectTask $project, array $data)
    {
        $project->update($data);

        return $project;
    }

    public function delete(ProjectTask $project)
    {
        return $project->delete();
    }
}
