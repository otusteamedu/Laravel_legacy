<?php

namespace App\Listeners;

use App\Services\Cache\Repositories\CacheRepositoryInterface;
use App\Services\Events\Models\User\UserIsAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WarmUpUserCache
{
    private $cacheRepository;

    /**
     * Create the event listener.
     *
     * @param CacheRepositoryInterface $cacheRepository
     */
    public function __construct(CacheRepositoryInterface $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserIsAdmin  $event
     * @return void
     */
    public function handle(UserIsAdmin $event)
    {
        Log::info("3. Здесь буду разогревать кэш.");
        $this->cacheRepository->warmupUserCache();
        Log::info("4. Кэш разогрет.");
    }
}
