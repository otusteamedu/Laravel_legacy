<?php
/**
 * Description of TasksService.php
 *
 *
 */

namespace App\Services\Tasks;


use App\Models\Task;

use App\Services\Tasks\Repositories\EloquentTaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Services\Tasks\Repositories\TaskRepositoryInterface;
use App\Services\Tasks\Repositories\CachedTaskRepositoryInterface;


class TasksService
{
    /** @var TaskRepositoryInterface */
    private $taskRepository;
    /** @var CachedTaskRepositoryInterface */
    private $cachedTaskRepository;

    private $createTaskHandler;

    public function __construct(

        TaskRepositoryInterface $taskRepository,
        CachedTaskRepositoryInterface $cachedTaskRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->cachedTaskRepository = $cachedTaskRepository;
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function findTask(int $id)
    {
        // return $this->taskRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchTasks()
    {
        return $this->taskRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchTasksToArray($filters = [])
    {
        return $this->taskRepository->searchToArray($filters);

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchTasksByUsers($filters = [])
    {
        return $this->taskRepository->searchByUsers($filters);

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchTaskPermissions(Task $task)
    {
        return $this->taskRepository->permissions($task);

    }

    /**
     * @param array $data
     * @return Task
     */
    public function storeTask(array $data): Task
    {
        $task = $this->taskRepository->create($data);
        return $task;
    }

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function updateTask(Task $task, array $data)
    {
        return $this->taskRepository->updateFromArray($task, $data);
    }

    public function deleteTask(int $id)
    {
        return $this->taskRepository->delete($id);
    }

    public function searchCachedTasks(array $filter = []): LengthAwarePaginator
    {
        return $this->cachedTaskRepository->search($filter);
    }


}