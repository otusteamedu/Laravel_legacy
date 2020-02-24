<?php

namespace App\Http\Controllers\Cms\User\User;

use App\Http\Controllers\Cms\User\User\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\User\User\Requests\UpdateUserRequest;
use App\Models\User\User;
use App\Policies\Abilities;
use App\Services\Cms\User\GroupsService;
use App\Services\Cms\User\UsersService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class UsersController
 * @package App\Http\Controllers\Cms\User\User
 */
class UsersController extends Controller
{
    /** @var UsersService $usersService */
    protected $usersService;

    /** @var GroupsService $groupsService */
    protected $groupsService;

    public function __construct(UsersService $usersService, GroupsService $groupsService)
    {
        $this->usersService = $usersService;
        $this->groupsService = $groupsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, User::class);

        return view('cms.user.index', [
            'users' => $this->usersService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, User::class);

        return  view(
            'cms.user.create',
            [
                'groups' => $this->groupsService->getArrayList(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize(Abilities::CREATE, User::class);

        $url = $this->usersService->store($request);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize(Abilities::VIEW, $user);

        return view(
            'cms.user.show',
            [
                'user' => $user,
                'image' => $this->usersService->getUserImage($user),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        return view(
            'cms.user.edit',
            [
                'user' => $user,
                'groups' => $this->groupsService->getArrayList(),
                'image' => $this->usersService->getUserImage($user),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        $url = $this->usersService->update($user, $request);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize(Abilities::DELETE, $user);

        $url = $this->usersService->destroy($user);

        return redirect($url);
    }
}
