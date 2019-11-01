<?php

namespace App\Console\Commands;

use App\Services\Tasks\TasksService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tasks 
                            {users* : The users ids who tasks need to import }
                            {--path= : The path where tasks\'ll be imported }
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users\'s tasks to file.';

    private $tasksService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TasksService $tasksService)
    {
        parent::__construct();
        $this->tasksService = $tasksService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $opts = $this->options();
        $args = $this->arguments();

        $tasks = $this->tasksService->searchTasksByUsers($args['users'])->toJson(JSON_PRETTY_PRINT);;
        if (Storage::put($this->getFileName($opts['path'], $args['users']), $tasks)) {
            $this->info("Tasks were imported");
        }
    }

    private function getFileName($path, $users)
    {
        return $path . '/tasks_' . implode('_', $users) . '.json';
    }
}