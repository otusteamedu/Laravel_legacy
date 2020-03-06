<?php


namespace App\Services\User\Handlers;


use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class StoreUserHandler
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
     * @param array $storeData
     * @return User
     */
    public function handle(array $storeData): User
    {
        $storeData['password'] = bcrypt($storeData['password']);

        if (!Arr::has($storeData, 'role'))
            $storeData['role'] = config('roles.default_role');

        return  $this->repository->store($storeData);
    }
}
