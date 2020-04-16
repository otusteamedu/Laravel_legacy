<?php

namespace App\Http\Controllers\Cms\Users;

use App\Http\Controllers\Cms\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Users\Requests\StoreCityRequest;
use App\Models\Segment;
use App\Models\Tariff;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Users\UsersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class UsersController extends Controller
{
    /**
     * @var UsersService
     */
    protected $usersService;

    public function __construct(
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(config('view.cms.users.index'), [
            'users' => User::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(User $user)
    {
        $this->authorize(Abilities::CREATE, $user);

        $tariffs = Tariff::all();
        $segments = Segment::all();

        return view(config('view.cms.users.create'), [
            'tariffs' => $tariffs,
            'segments' => $segments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @param User $user
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreUserRequest $request, User $user)
    {
        $this->authorize(Abilities::CREATE, $user);

        $data = $request->getFormData();

        try {
            $this->usersService->storeUser($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store user error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.users.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $this->authorize(Abilities::VIEW, $user);

        return view(config('view.cms.users.show'), [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        return view(config('view.cms.users.edit'), [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        try {
            //$this->usersService->updateUser($user, $request->all());
            $user->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update user error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.users.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return false;
    }
}
