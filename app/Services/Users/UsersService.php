<?php


namespace App\Services\Users;


use App\Services\Users\Repositories\EloquentUserRepository;

class UsersService
{
    protected $usersRepository;

    public function __construct(EloquentUserRepository $eloquentUserRepository)
    {
        $this->usersRepository = $eloquentUserRepository;
    }

    public function getFormUsers()
    {
        return $this->usersRepository->getAllUsers();
    }
}
