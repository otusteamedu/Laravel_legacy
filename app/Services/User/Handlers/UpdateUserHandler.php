<?php


namespace App\Services\User\Handlers;


use App\Http\Requests\FormRequest;
use App\Models\User;
use App\Services\User\Repositories\UserRepository;
use Illuminate\Support\Arr;

class UpdateUserHandler
{
    /**
     * @param FormRequest $request
     * @param User $user
     * @param UserRepository $repository
     * @return User
     */
    public function handle(FormRequest $request, User $user, UserRepository $repository): User {
        if ($request->has('old_password', 'password') && $request->filled(['old_password', 'password'])) {
            $repository->setPassword($request['old_password'], $request['password'], $user);
        }

        $data = Arr::collapse([
            $request->except('old_password', 'password'),
            'publish' => $request['publish'] ?? 0
        ]);

        return $repository->update($data, $user);
    }
}
