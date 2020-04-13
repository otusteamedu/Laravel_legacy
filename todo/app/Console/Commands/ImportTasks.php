<?php

namespace App\Console\Commands;

use App\Services\Tasks\Handlers\ImportTasksHandler;
use Illuminate\Console\Command;


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

    private $importTasksHandler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportTasksHandler $importTasksHandler)
    {
        parent::__construct();
        $this->importTasksHandler = $importTasksHandler;
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
        if($this->importTasksHandler->handle($args, $opts))
        {
            $this->info("Tasks were imported");
        }
    }

}