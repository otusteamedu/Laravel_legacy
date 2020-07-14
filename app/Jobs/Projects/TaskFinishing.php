<?php

namespace App\Jobs\Projects;

use App\Models\ProjectTask;
use App\Services\ProjectTasks\ProjectTasksEmailsService;
use Drek\Laravel\Notifications\Services\Notifications\NotificationsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskFinishing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ProjectTask
     */
    private $task;

    /**
     * Create a new job instance.
     *
     * @param ProjectTask $task
     */
    public function __construct(ProjectTask $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @param NotificationsService      $notificationsService
     * @param ProjectTasksEmailsService $projectTasksEmailsService
     *
     * @return void
     */
    public function handle(
        //NotificationsService $notificationsService,
        ProjectTasksEmailsService $projectTasksEmailsService
    )
    {
        // @todo add to bill

       /*
        $notificationsService->create([
            // @todo
        ]);*/

        $projectTasksEmailsService->finishedForAllUsers($this->task);
    }
}
