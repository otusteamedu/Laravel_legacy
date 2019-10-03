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

    public function createUser()
    {
        $user = $this->userRepository->create($data);
    }
}