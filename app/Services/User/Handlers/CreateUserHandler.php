<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class CreateUserHandler
{
    /**
     * @param FormRequest $request
     * @param UserRepository $repository
     * @return User
     */
    public function handle(FormRequest $request, UserRepository $repository): User
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if (!Arr::has($data, 'roles'))
            $data['roles'] = config('roles.default_role');

        return  $repository->store($data);
    }
}
