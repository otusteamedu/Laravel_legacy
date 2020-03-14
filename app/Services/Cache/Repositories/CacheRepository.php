<?php

namespace App\Services\Cache\Repositories;
use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheRepository implements CacheRepositoryInterface
{
    private $userRepository;

    /**
     * CacheRepository constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get's all users.
     * @return mixed
     */
    public function getAllUsers()
    {
        if(Cache::has('users'))
        {
            // верни значение из кэша
            return Cache::get('users');
        }
        else
        {
            // если нет в кэше
            // получи из БД
            $users = $this->userRepository->all();
            // $users = User::all();
            // запомни в кэш
            Cache::forever('users',$users);
            // и только потом верни
            return $users;
        }
    }

    /**
     * Очистить кэш, хранящий всех пользователей
     */
    public function clearUserCache()
    {
        Cache::flush();
        Log::info("Кэш очищен.");
    }
}
