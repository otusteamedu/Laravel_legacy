<?php
/**
 * Created by PhpStorm.
 * User: romchik
 * Date: 17.09.2019
 * Time: 13:00
 */

namespace App\Services\User;



use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Получаем список пользователей
     * @return mixed
     */
    public function getUsers()
    {
        $users = $this->userRepository->getAll();

        return $users;
    }

    /**
     * Получаем текущего авторизированного пользователя
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getCurrentUser()
    {
        $currentUser = Auth::user();

        return $currentUser;
    }

    public function createUser($data)
    {
        try {
            $user = $this->userRepository->add($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            //TODO: вывод флеш
            return fasle;
        }
    }

    public function activate($userId)
    {
        try {
            $this->userRepository->activate($userId);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function unactivate($userId)
    {
        try {
            $this->userRepository->deactivate($userId);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}