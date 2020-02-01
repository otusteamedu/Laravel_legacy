<?php

namespace App\Http\Controllers\CMS\Users;

use App\Models\User;
use App\Http\Controllers\CMS\Users\Requests\UpdateUserRequest;
use App\Http\Controllers\CMS\Users\Requests\CreateUserRequest;
use App\Http\Controllers\CMS\Users\Requests\UpdateProfileRequest;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Http\Response;
use App\Services\Users\UsersService;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    // Добавил для паттерна Репозиторий
    protected $user;
    protected $usersService;

    /**
     * UsersController constructor.
     *
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user, UsersService $userService)
    {
        $this->user = $user;
        $this->usersService = $userService;
        $this->middleware('auth');
        $this->middleware('admin-only')->except('updateProfile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->all();
        return view('pages.admin.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->getFormData();
        $user = $this->usersService->createUser($data);
        return redirect(route('cms.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('pages.admin.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('pages.admin.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // входящий запрос валидный
        $data = [
            'source' => request('source'),
            'type' => request('type'),
            'operator' => request('operator'),
            'name' => request('name'),
            'phone' => request('phone'),
            'email' => request('email'),
            'address' => request('address'),
            'comments' => request('comments'),
        ];

        $user = $this->usersService->updateUser($user, $data);
        return redirect(route('cms.users.show', ['user' => $user]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('cms.users.index'));
    }

    /**
     * Update user profile
     *
     * @param \App\Http\Controllers\CMS\Users\Requests\UpdateProfileRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        if (auth()->user()->cant('update', $user)) {
            abort(403);
        }
        // входящий запрос валидный
        // и пользователь имеет полномочия обновить данные
        $data = [
            'source' => config('shop.default_type'),
            'type' => config('shop.default_type'),
            'name' => request('name'),
            'phone' => request('phone'),
            'email' => request('email'),
            'address' => request('address'),
        ];

        $user = $this->usersService->updateProfile($user, $data);
        $updated = true;
        return redirect(route('profile', ['user' => $user, 'updated' => $updated]));
    }

}
