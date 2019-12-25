<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheService;
use App\Services\User\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class WarmupCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warmup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warmup app cache';

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * Create a new command instance.
     *
     * @param  UserService  $userService
     * @param  CacheService  $cacheService
     */
    public function __construct(UserService $userService, CacheService $cacheService)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->cacheService = $cacheService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Cache::flush();
        $users = $this->userService->all();
        if (!$users->count()) {
            $this->error('No users found');
            return;
        }
        foreach ($users as $user) {
            $this->cacheService->warmupCacheByUser($user);
            $this->line('Warmed up cache for '.$user->name);
        }
    }
}
