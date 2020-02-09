<?php

namespace App\Http\Controllers\Cms\User\User;

use App\Http\Controllers\Cms\User\User\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\User\User\Requests\UpdateUserRequest;
use App\Models\User\User;
use App\Services\Cms\User\GroupsService;
use App\Services\Cms\User\UsersService;
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

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.user.index', [
            'users' => $this->usersService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        /** @var GroupsService $groupsService */
        $groupsService = app(GroupsService::class);

        return  view(
            'cms.user.create',
            [
                'groups' => $groupsService->getArrayList(),
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
        $url = $this->usersService->store($request);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
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
     */
    public function edit(User $user)
    {
        /** @var GroupsService $groupsService */
        $groupsService = app(GroupsService::class);

        return view(
            'cms.user.edit',
            [
                'user' => $user,
                'groups' => $groupsService->getArrayList(),
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
        $url = $this->usersService->update($user, $request);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse|Redirector
     */
    public function destroy(User $user)
    {
        $url = $this->usersService->destroy($user);

        return redirect($url);
    }
}
