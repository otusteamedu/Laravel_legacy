<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use App\Services\Cache\Handlers\WarmupCacheHandler;

/**
 * Консольная команда для прогрева кэша
 * Class CacheWarmUp
 * @package App\Console\Commands
 */
class CacheWarmUp extends Command
{
    /**
     * The name and signature of the console command.
     * в дальнейшем кеш расширю для остальных моделей
     *
     * @var string
     */
    protected $signature = 'cache:warmup 
        {--films : Warmup cache for films} 
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache warm up';


    private $warmupCacheHandler;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WarmupCacheHandler $warmupCacheHandler)
    {
        $this->warmupCacheHandler = $warmupCacheHandler;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $options = $this->option();
        if (!empty($options['films'])) {
            $ts = microtime(true);
            $this->warmupCacheHandler->warmUpForFilms();
            $time = microtime(true) - $ts;
            $this->info('Films cache clear: ' . $time . 's');
        }
        if (empty($options['cms']) && empty($options['films'])) {
            $this->info("Nothing to do!");
        }
    }
}