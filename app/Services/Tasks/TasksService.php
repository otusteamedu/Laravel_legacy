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

    public function getForm(int $paginate)
    {
        return $this->tasksRepository->getTasks($paginate);
    }

    public function updateForm(Task $task, array $data)
    {
        return $this->tasksRepository->updateTask($task, $data);
    }

    public function deleteForm(int $id)
    {
        return $this->tasksRepository->destroyTask($id);
    }

    public function getFormCreate(array $data)
    {
        return $this->tasksRepository->createTask($data);
    }

    public function getFormProjects()
    {
        return $this->tasksRepository->getProjects();
    }

    public function getFormUsers()
    {
        return $this->tasksRepository->getUsers();
    }
}
