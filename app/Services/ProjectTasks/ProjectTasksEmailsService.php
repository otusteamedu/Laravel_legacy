<?php


namespace App\Services\ProjectTasks;


use App\Models\ProjectTask;
use App\Models\User;
use App\Services\ProjectTasks\Handlers\SendFinishedEmail;

/**
 * Class ProjectTasksEmailsService
 *
 * @package App\Services\ProjectTasks
 */
class ProjectTasksEmailsService
{

    /**
     * @var SendFinishedEmail
     */
    private $sendFinishedEmail;

    /**
     * ProjectTasksEmailsService constructor.
     *
     * @param SendFinishedEmail $sendFinishedEmail
     */
    public function __construct(SendFinishedEmail $sendFinishedEmail)
    {
        $this->sendFinishedEmail = $sendFinishedEmail;
    }

    /**
     * Отправить e-mail о завершение таска всем пользователям проекта
     *
     * @param ProjectTask $projectTask
     */
    public function finishedForAllUsers(ProjectTask $projectTask)
    {
        foreach ($projectTask->project()->get()->first()->users()->get() as $user) {
            $this->finished($projectTask, $user);
        }
    }

    /**
     * Отправить e-mail о завершение таска пользователю
     *
     * @param ProjectTask $projectTask
     * @param User        $user
     */
    public function finished(ProjectTask $projectTask, User $user)
    {
        $this->sendFinishedEmail->handle($projectTask, $user);
    }

}
