<?php


namespace App\Services\User\Handlers;


use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class UpdateUserHandler
{
    private UserRepository $repository;

    /**
     * StoreUserHandler constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @param array $updateData
     * @return User
     */
    public function handle( User $user, array $updateData): User
    {
        if (Arr::has($updateData, ['old_password', 'password'])
            && !empty($updateData['old_password'])
            && !empty($updateData['password'])) {
            $this->repository->setPassword($user, $updateData['old_password'], $updateData['password']);
        }

        $updateData['publish'] = $updateData['publish'] ?? 0;

        return $this->repository->update($user, Arr::except($updateData, ['old_password', 'password']));
    }
}
