<?php

namespace App\Services\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

/**
 * Репозиторий для работы с cache
 *
 * Class UserCacheRepository
 * @package App\Services\Repositories
 */
class UserCacheRepository
{
    const CACHE_KEY = 'USER';
    const CACHE_TAG_NAME = 'USERS';
    const CACHE_TTL = 60;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserCacheRepository constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array|null $options
     * @return mixed
     */
    public function paginated(array $options = null)
    {
        $users = \Cache::tags(self::CACHE_TAG_NAME)->remember(self::getCacheKey('LIST'), Carbon::now()->addMinutes(self::CACHE_TTL), function () use ($options) {
            return $this->userRepository->paginated($options);
        });
        return $users;
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
