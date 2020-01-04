<?php


namespace App\Services\Admin\Users\Handlers;


use App\Services\Admin\Users\Repositories\UsersRepository;
use App\Models\User;


/**
 * Class UpdateUserHandler
 * @package App\Services\Admin\Users\Handlers
 */
class UpdateUserHandler
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * GetUsersListHandler constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository)
    {
        $this->usersRepository = $repository;
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function handle(User $user, array $data)
    {
        return $this->usersRepository->updateUser($user, $data);
    }
}
