<?php
/**
 * Created by PhpStorm.
 * User: romchik
 * Date: 17.09.2019
 * Time: 13:00
 */

namespace App\Services\User;


use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        $users = $this->userRepository->get([]);

        return $users;
    }
}