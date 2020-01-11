<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class CreateUserHandler
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
     * @param FormRequest $request
     * @return User
     */
    public function handle(FormRequest $request): User
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        return $this->repository->store($data);
    }
}
