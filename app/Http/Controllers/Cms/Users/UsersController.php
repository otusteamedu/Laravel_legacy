<?php

namespace App\Http\Controllers\Cms\Users;

use App\Http\Controllers\Cms\CmsController;
use App\Http\Controllers\Cms\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\Users\Requests\UpdateUserRequest;
use App\Policies\Abilities;
use Illuminate\Http\UploadedFile;
use mysql_xdevapi\Exception;
use View;
use App\Models\User;
use App\Services\Users\UsersService;

class UsersController extends CmsController
{

    /** @var UsersService */
    private $usersService;

    public function __construct(
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, User::class);

        $users = $this->usersService->search();

        View::share([
            'users' => $users,
        ]);

        return view('cms.users.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, User::class);
        return view('cms.users.create');
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize(Abilities::CREATE, User::class);
        $data = $request->validated();
        $this->usersService->createUser($data);

        return redirect(route('cms.users.index'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize(Abilities::VIEW, $user);
        View::share([
            'user' => $user,
        ]);
        return view('cms.users.show');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);
        View::share([
            'user' => $user,
        ]);
        return view('cms.users.edit');
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storePhoto($request->file('photo'));
        }
        $this->usersService->updateUser($user, $data);
        $this->setSuccessSavedState();

        return redirect(route('cms.users.index'));
    }

    private function storePhoto(UploadedFile $photo)
    {
        return $photo->store('users/photo', 'public');
    }
}
