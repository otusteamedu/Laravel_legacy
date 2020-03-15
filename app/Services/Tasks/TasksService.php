<?php


namespace App\Services\Tasks;


use App\Models\Task;
use App\Services\Tasks\Repositories\EloquentTasksRepository;

class TasksService
{
    protected $tasksRepository;

    public function __construct(EloquentTasksRepository $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function getTask(int $paginate)
    {
        return $this->tasksRepository->getForm($paginate);
    }

    public function updateTask(Task $task, array $data)
    {
        return $this->tasksRepository->updateForm($task, $data);
    }

    public function deleteTask(Task $task)
    {
        return $this->tasksRepository->destroyTask($task);
    }

    public function createTask(array $data)
    {
        return $this->tasksRepository->getFormCreate($data);
    }

}
