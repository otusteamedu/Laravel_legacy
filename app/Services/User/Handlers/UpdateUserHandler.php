<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class UpdateUserHandler
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
     * @param User $user
     * @return User
     */
    public function handle(FormRequest $request, User $user): User {
        if ($request->has('old_password', 'password') && $request->filled(['old_password', 'password'])) {
            $this->repository->setPassword($request['old_password'], $request['password'], $user);
        }

        $data = Arr::collapse([
            $request->except('old_password', 'password'),
            'publish' => $request['publish'] ?? 0
        ]);

        return $this->repository->update($data, $user);
    }
}
