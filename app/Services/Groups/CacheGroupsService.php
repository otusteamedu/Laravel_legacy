<?php

namespace App\Services\Groups;

use App\Models\Group;
use App\Services\Interfaces\CacheServiceInterface;

/**
 * Class CacheGroupsService
 * Сервис для работы с кэшем групп
 *
 * @package App\Services\Groups
 */
class CacheGroupsService implements CacheServiceInterface
{

    /** {@inheritDoc} */
    public function clear()
    {
        Group::flushCache();
    }

    /** {@inheritDoc} */
    public function warm()
    {
        Group::whereIn('id', Group::CLIENTS)->get();
        Group::whereIn('id', Group::STAFFS)->get();
        Group::whereId(Group::STAFF_ADMIN)->get();
        Group::whereId(Group::STAFF_DEVELOPER)->get();
        Group::whereId(Group::STAFF_MANAGER)->get();
    }
}
