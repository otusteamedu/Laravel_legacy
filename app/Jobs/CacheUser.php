<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Cache\Users\UsersCacheService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

/**
 * Class CacheUser
 * @package App\Jobs
 */
class CacheUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     * @param $user User
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     * @param $usersCacheService UsersCacheService
     * @return void
     */
    public function handle(UsersCacheService $usersCacheService)
    {
        Log::info("Cache user {$this->user->id}");
        $usersCacheService->putUserDataToCache($this->user->id, $this->user);
    }
}
