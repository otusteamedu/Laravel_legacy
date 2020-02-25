<?php


namespace App\Services\Cache\Users;


use App\Services\Cache\CacheConstants;
use Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UsersCacheService
 * @package App\Services\Cache\Users
 */
class UsersCacheService
{
    /**
     * @param string $uri
     * @return bool|mixed
     */
    public function getUserListFromCache(string $uri)
    {
        $key = md5($uri);
        if (Cache::tags([CacheConstants::USERS_LIST_TAG, CacheConstants::USER_ENTITY_TAG])->has($key)) {
            return Cache::tags([CacheConstants::USERS_LIST_TAG, CacheConstants::USER_ENTITY_TAG])->get($key);
        }
        return false;
    }

    /**
     * @param string $uri
     * @param LengthAwarePaginator $usersList
     * @return bool
     */
    public function putUsersListToCache(string $uri, LengthAwarePaginator $usersList)
    {
        $key = md5($uri);
        return Cache::tags([
            CacheConstants::USERS_LIST_TAG,
            CacheConstants::USER_ENTITY_TAG
        ])->put($key, $usersList, CacheConstants::TIME_FOR_USERS_LIST);
    }

    /**
     * @param int $id
     * @param string $uri
     * @return bool|mixed
     */
    public function getUserDataFromCache(int $id, string $uri)
    {
        $key = md5("{$uri}{$id}");
        if (Cache::tags([CacheConstants::USER_TAG, CacheConstants::USER_ENTITY_TAG])->has($key)) {
            return Cache::tags([CacheConstants::USER_TAG, CacheConstants::USER_ENTITY_TAG])->get($key);
        }
        return false;
    }

    /**
     * @param int $id
     * @param string $uri
     * @param $data
     * @return bool
     */
    public function putUserDataToCache(int $id, string $uri, $data)
    {
        $key = md5("{$uri}{$id}");
        return Cache::tags([
            CacheConstants::USER_TAG,
            CacheConstants::USER_ENTITY_TAG
        ])->put($key, $data, CacheConstants::TIME_FOR_USER);
    }
}
