<?php


namespace App\Services\User\Handlers;


use App\Models\User;
use App\Services\User\Repositories\UserRepository;

class SetUserPasswordHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @param User $user
     */
    public function handle(string $oldPassword, string $newPassword, User $user) {
        $this->repository->setPassword($oldPassword, $newPassword, $user);
    }
}
