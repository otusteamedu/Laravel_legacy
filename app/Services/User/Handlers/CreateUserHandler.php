<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepositoryCms;
use Illuminate\Support\Arr;

class CreateUserHandler
{
    /**
     * @param FormRequest $request
     * @param UserRepositoryCms $repository
     * @return User
     */
    public function handle(FormRequest $request, UserRepositoryCms $repository): User
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if (!Arr::has($data, 'role'))
            $data['role'] = config('roles.default_role');

        return  $repository->store($data);
    }
}
