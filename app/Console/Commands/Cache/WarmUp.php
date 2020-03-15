<?php

namespace App\Console\Commands\Cache;

use App\Services\Cache\WarmUpService;
use Illuminate\Console\Command;

class WarmUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm-up
                            {module?* : модули где необходимо прогреть кеш, отсутсвие значение делает полные прогрев}
                            {--sleep=1 : задержка после каждого модуля}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Прогрев кеша';

    /** @var WarmUpService  */
    protected $warmUpService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WarmUpService $warmUpService)
    {
        $this->warmUpService = $warmUpService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modules = $this->argument('module');
        $sleep = (int) $this->option('sleep');
        try {
            $this->warmUpService->upCache($modules, $sleep);
            $this->info('Кеш прогрет');
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
        }
    }
}
