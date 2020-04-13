<?php

namespace App\Services\Tasks\Handlers;

use App\Services\Tasks\TasksService;
use Illuminate\Support\Facades\Storage;

class ImportTasksHandler
{
    private $tasksService;

    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    /**
     * Execute the import tasks to file
     *
     * @return mixed
     */
    public function handle($args,$opts)
    {
        $tasks = $this->tasksService->searchTasksByUsers($args['users'])->toJson(JSON_PRETTY_PRINT);;
        if (Storage::put($this->getFileName($opts['path'], $args['users']), $tasks)) {

            return 1;
        }
        else
            return 0;
    }

    private function getFileName($path, $users)
    {
        return $path . '/tasks_' . implode('_', $users) . '.json';
    }
}