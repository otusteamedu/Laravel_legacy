<?php

namespace App\Http\Controllers\Web\Users;

use App\Models\User;
use App\Policies\Abilities;
use App\Services\Users\UsersService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Users\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function update(UpdateUserRequest $request, User $user) {
        $this->authorize(Abilities::UPDATE, User::class);
        $this->usersService->updateUser($user, $request->getFormData());

        return redirect(route('personal.index', $user));
    }
}
