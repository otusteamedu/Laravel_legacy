<?php

namespace App\Console\Commands;

use App\Services\Groups\CacheGroupsService;
use Illuminate\Console\Command;

/**
 * Class WarmCache
 * Команда для прогрева кэша
 * @package App\Console\Commands
 */
class WarmCache extends Command
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
    protected $description = 'Method for warming up the cache';
    /**
     * @var CacheGroupsService
     */
    private $cacheGroupsService;

    /**
     * Create a new command instance.
     *
     * @param CacheGroupsService $cacheGroupsService
     */
    public function __construct(CacheGroupsService $cacheGroupsService)
    {
        parent::__construct();
        $this->cacheGroupsService = $cacheGroupsService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->warmGroup();
    }

    /**
     * Прогреть кэш групп
     */
    private function warmGroup()
    {
        $this->cacheGroupsService->clear();
        $this->cacheGroupsService->warm();
        $this->info('Group cache warmed!');
    }
}
