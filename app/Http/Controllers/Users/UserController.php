<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Users\UsersService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class UserController extends Controller
{

    protected $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->authorizeResource(User::class, 'profile');

        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        \View::share(
            [
                'user' => $request->user(),
            ]
        );

        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     *
     * @return void
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     *
     * @return void
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * @param  UpdateUserRequest  $request
     * @param  User  $profile
     *
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, User $profile)
    {
        $data = $request->getFormData();

        if ($this->usersService->update($profile, $data)) {
            \Session::flash('message', 'Profile successfully updated!');
        }

        \View::share(
            [
                'user' => $profile,
            ]
        );

        return redirect(route('profile.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     *
     * @return void
     */
    public function destroy(User $user)
    {
        //
    }
}
