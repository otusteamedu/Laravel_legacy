<?php

namespace App\Services\ProjectTasks;

use App\Services\ProjectTasks\Handlers\FinishingHandler;

/**
 * Class ProjectTasksService
 *
 * Сервис для работы с тикетами проекта
 *
 * @package App\Services\ProjectTasks
 */
class ProjectTasksService
{
    /**
     * @var FinishingHandler
     */
    private $finishingHandler;

    /**
     * ProjectTasksService constructor.
     *
     * @param FinishingHandler $finishingHandler
     */
    public function __construct(FinishingHandler $finishingHandler)
    {
        $this->finishingHandler = $finishingHandler;
    }

    /**
     * Завершить тикет
     *
     * @param int $id
     */
    public function finished(int $id)
    {
        $this->finishingHandler->handle($id);
    }

}
