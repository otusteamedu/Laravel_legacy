<?php


namespace App\Services\User\Handlers;


use App\Models\User;
use App\Services\User\Repositories\ClientUserRepository;
use Illuminate\Support\Facades\Hash;

class ClientCreateHandler
{
    private ClientUserRepository $repository;

    /**
     * StoreUserHandler constructor.
     * @param ClientUserRepository $repository
     */
    public function __construct(ClientUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $requestData
     * @return User
     */
    public function handle(array $requestData): User
    {
        $requestData['password'] = Hash::make($requestData['password']);

        return  $this->repository->store($requestData, User::DEFAULT_ROLE);
    }
}
