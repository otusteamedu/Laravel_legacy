<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Interfaces\CacheServiceInterface;

/**
 * Class UsersCacheService
 * Сервис для работы с кэшем пользователей
 *
 * @package App\Services\Users
 */
class UsersCacheService implements CacheServiceInterface
{

    /** {@inheritDoc} */
    public function clear()
    {
        User::flushCache();
    }

    /** {@inheritDoc} */
    public function warm()
    {
        // @todo
    }
}
