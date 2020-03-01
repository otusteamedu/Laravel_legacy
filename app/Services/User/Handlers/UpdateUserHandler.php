<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepositoryCms;
use Illuminate\Support\Arr;

class UpdateUserHandler
{
    /**
     * @param FormRequest $request
     * @param User $user
     * @param UserRepositoryCms $repository
     * @return User
     */
    public function handle(FormRequest $request, User $user, UserRepositoryCms $repository): User
    {
        if ($request->has('old_password', 'password') && $request->filled(['old_password', 'password'])) {
            $repository->setPassword($request['old_password'], $request['password'], $user);
        }

        $request->publish = $request->publish ?? 0;

        return $repository->update($request->except('old_password', 'password'), $user);
    }
}
