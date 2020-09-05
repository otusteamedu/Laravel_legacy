<?php

namespace App\Services\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

/**
 * Репозиторий для работы с cache
 *
 * Class UserGroupCacheRepository
 * @package App\Services\Repositories
 */
class UserGroupCacheRepository
{
    const CACHE_KEY = 'USERGROUP';
    const CACHE_TAG_NAME = 'USERGROUPS';
    const CACHE_TTL = 60;

    /**
     * @var UserGroupRepository
     */
    private $userGroupRepository;

    /**
     * UserGroupCacheRepository constructor.
     * @param UserGroupRepository $userGroupRepository
     */
    public function __construct(UserGroupRepository $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * @param array|null $options
     * @return mixed
     */
    public function paginated(array $options = null)
    {
        $usergroups = \Cache::tags(self::CACHE_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
            return $this->userGroupRepository->paginated($options);
        });
        return $usergroups;
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getList(array $options = null)
    {
        $usergroups = \Cache::tags(self::CACHE_TAG_NAME)->remember($this->getCacheKey('LIST'), Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
            return $this->userGroupRepository->getAll(['id', 'title']);
        });
        $usergroupList = [];
        foreach ($usergroups as $usergroup) {
            $usergroupList[$usergroup->id] = $usergroup->title;
        }
        return $usergroupList;
    }

    /**
     * @param $prefix
     * @return string
     */
    public function getCacheKey($prefix)
    {
        return $prefix . '_' . self::CACHE_KEY;
    }

    /**
     * Очистка кэша
     */
    public function clear()
    {
        \Cache::tags(self::CACHE_TAG_NAME)->flush();
    }
}
