<?php

namespace App\Console\Commands\Cache;

use App\Services\Cache\CacheManager;
use Illuminate\Console\Command;

class WarmUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm-up
                           {tag? : Tag name associated the cache data}
                           {--ttl= : Cache time to live}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private CacheManager $cacheManager;

    /**
     * WarmUpCategoryCache constructor.
     * @param CacheManager $cacheManager
     */
    public function __construct(CacheManager $cacheManager)
    {
        parent::__construct();
        $this->cacheManager = $cacheManager;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tag = $this->argument('tag');
        $ttl = $this->option('ttl');

        $this->cacheManager->setByTag($tag, $ttl)
            ? $this->info("Cache warm-up by tag '$tag' successfully completed!")
            : $this->error("Cache warming up failed for '$tag' tag");
    }
}
