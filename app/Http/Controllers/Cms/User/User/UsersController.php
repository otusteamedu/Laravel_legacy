<?php

namespace App\Http\Controllers\Cms\User\User;

use App\Http\Controllers\Cms\CurrentUser;
use App\Http\Controllers\Cms\User\User\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\User\User\Requests\UpdateUserRequest;
use App\Models\User\Group;
use App\Models\User\User;
use App\Policies\Abilities;
use App\Services\Cms\User\GroupsService;
use App\Services\Cms\User\UsersService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class UsersController
 * @package App\Http\Controllers\Cms\User\User
 */
class UsersController extends Controller
{
    use CurrentUser;

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
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, User::class);

        return view('cms.user.index', [
            'users' => $this->usersService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $this->checkAbility($request, Abilities::CREATE, User::class);

        return view(
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
     */
    public function store(StoreUserRequest $request)
    {
        $this->checkAbility($request, Abilities::CREATE, User::class);

        $url = $this->usersService->store($request);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param User $user
     * @return Factory|View
     */
    public function show(Request $request, User $user)
    {
        $this->checkAbility($request, Abilities::VIEW, $user);

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
     * @param Request $request
     * @param User $user
     * @return Factory|View
     */
    public function edit(Request $request, User $user)
    {
        $this->checkAbility($request, Abilities::UPDATE, $user);

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
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->checkAbility($request, Abilities::UPDATE, $user);

        $url = $this->usersService->update($user, $request);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, User $user)
    {
        $this->checkAbility($request, Abilities::DELETE, $user);

        $url = $this->usersService->destroy($user);

        return redirect($url);
    }
}
