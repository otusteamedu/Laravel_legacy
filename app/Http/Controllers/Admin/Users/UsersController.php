<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUsersRequest;
use App\Http\Services\Roles\RolesService;
use App\Http\Services\Users\UsersService;
use App\Models\Role;
use App\Models\User;
use App\Policies\Abilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->usersService->getUsersFromUser();
        return view('admin.user.page', ['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $arrayRoles = $this->usersService->getRoleFromUser();
        return view('admin.user.page', [
            'user'=>$user,
            'arrayRoles'=>$arrayRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UpdateUsersRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        $requestArray = $request->getFormArray();
        $this->usersService->updateUser($user, $requestArray);
        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->usersService->deleteUser($user);
        return redirect(route('admin.user.index'));
    }
}
