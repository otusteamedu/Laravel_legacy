<?php

namespace App\Console\Commands;

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
     *
     * @var string
     */
    protected $signature = 'cache:warmup 
        {--users : Warmup cache for users} 
        {--cms : Warmup cache for CMS}';

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
        if (!empty($options['cms'])) {
            $ts = microtime(true);
            $this->warmupCacheHandler->warmUpForCms();
            $time = microtime(true) - $ts;
            $this->info('Cms cache clear: ' . $time  . 's');
        }
        if (!empty($options['users'])) {
            $ts = microtime(true);
            $this->warmupCacheHandler->warmUpForUsers();
            $time = microtime(true) - $ts;
            $this->info('Users cache clear: ' . $time . 's');
        }
        if (empty($options['cms']) && empty($options['cms'])) {
            $this->info("Nothing to do!");
        }
    }
}
