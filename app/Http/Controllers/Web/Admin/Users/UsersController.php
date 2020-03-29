<?php

namespace App\Http\Controllers\Web\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Web\Admin\Users\Requests\UpdateUserRequest;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;

/**
 * Class UsersController
 * @package App\Http\Controllers\Web\Admin\Users
 */
class UsersController extends Controller
{
    protected $usersService;

    /**
     * UsersController constructor.
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Abilities::VIEW_ANY, User::class);

        $userList = $this->usersService->searchUsers($request->all());
        \View::share([
            'userList' => $userList
        ]);

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, User::class);

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize(Abilities::CREATE, User::class);

        $user = $this->usersService->storeUser($request->getFormData());

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize(Abilities::VIEW, User::class);

        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize(Abilities::UPDATE, User::class);

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize(Abilities::UPDATE, User::class);

        $this->usersService->updateUser($user, $request->getFormData());

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize(Abilities::DELETE, User::class);

        $this->usersService->deleteUser($user);

        return view(
            'admin.users.destroy',
            [
                'user' => $user
            ]
        );
    }
}
