<?php

namespace App\Services\Users\Repositories;

use App\Models\User;

class EloquentCacheUsersRepository extends EloquentUsersRepository implements UsersRepositoryInterface
{
    const CACHE_TTL = 60 * 60;

    const CACHE_TAG = 'users';

    public function find(int $id)
    {
        return User::remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)->whereId($id)->first();
    }

    public function search(array $groups, int $limit = 20)
    {
        return User::remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)->whereIn('group_id', $groups)->paginate($limit);
    }
}
