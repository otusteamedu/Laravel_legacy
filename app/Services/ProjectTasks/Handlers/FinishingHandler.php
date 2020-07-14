<?php


namespace App\Services\ProjectTasks\Handlers;


use App\Jobs\Projects\TaskFinishing;
use App\Jobs\Queue;
use App\Models\ProjectTask;
use App\Services\ProjectTasks\Repositories\ProjectTasksRepositoryInterface;

/**
 * Class FinishedHandler
 *
 * Завершение тикета
 *
 * @package App\Services\ProjectTasks\Handlers
 */
class FinishingHandler
{
    /**
     * @var ProjectTasksRepositoryInterface
     */
    private $projectTasksRepository;

    /**
     * FinishingHandler constructor.
     *
     * @param ProjectTasksRepositoryInterface $projectTasksRepository
     */
    public function __construct(ProjectTasksRepositoryInterface $projectTasksRepository)
    {
        $this->projectTasksRepository = $projectTasksRepository;
    }

    /**
     * @param int $id
     */
    public function handle(int $id)
    {
        $task = $this->projectTasksRepository->find($id);
        $this->projectTasksRepository->updateFromArray($task, ['status' => ProjectTask::STATUS_FINISHED]);

        TaskFinishing::dispatch($task)->onQueue(Queue::LOW);
    }
}
