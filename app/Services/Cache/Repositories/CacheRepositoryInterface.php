<?php
/** Для работы со всеми обращениями к БД. */
namespace App\Services\Cache\Repositories;
use App\Services\Users\Repositories\UserRepositoryInterface;
use test\Mockery\MockingVoidMethodsTest;

interface CacheRepositoryInterface
{

   public function __construct(UserRepositoryInterface $userRepository);

    /**
     * Get's all users.
     * @return mixed
     */
    public function getAllUsers();

    /**
     * Очистить кэш, хранящий всех пользователей
     */
    public function clearUserCache();
}
