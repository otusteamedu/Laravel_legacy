<?php

namespace App\Observers\Users;

use App\Models\User;
use App\Services\Cache\CacheConstants;
use Cache;
use Log;

/**
 * Class UsersCacheObserver
 * @package App\Observers\Users
 */
class UsersCacheObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        Log::info('Clear users cache');
        Cache::tags(CacheConstants::USERS_LIST_TAG)->flush();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        Log::info('Clear users cache');
        Cache::tags(CacheConstants::USER_TAG)->flush();
    }
}
