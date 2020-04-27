<?php


namespace App\Services\User\Handlers;


use App\Models\User;
use App\Services\User\Repositories\CmsUserRepository;
use Illuminate\Support\Facades\Hash;

class CmsCreateHandler
{
    private CmsUserRepository $repository;

    /**
     * StoreUserHandler constructor.
     * @param CmsUserRepository $repository
     */
    public function __construct(CmsUserRepository $repository)
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

        return  $this->repository->store($requestData);
    }
}
