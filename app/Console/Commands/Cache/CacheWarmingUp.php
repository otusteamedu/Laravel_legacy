<?php

namespace App\Console\Commands\Cache;

use App\Services\Cache\Handler\CacheWarmingHandler;
use Illuminate\Console\Command;

class CacheWarmingUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warming Cache';

    /**
     * @var CacheWarmingHandler
     */
    private $cacheWarmingHandler;

    public function __construct(
        CacheWarmingHandler $cacheWarmingHandler)
    {

        $this->cacheWarmingHandler = $cacheWarmingHandler;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->cacheWarmingHandler->forgetCacheKeys(
            [
                CacheKeyGenerator::HOME_LIST,
                CacheKeyGenerator::ADVERT_LIST,
                CacheKeyGenerator::MESSAGE_LIST
            ]
        );

        $this->cacheWarmingHandler->warmCache();

        echo 'Cache warmed'.PHP_EOL;

    }
}
