<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends MainController
{
    protected $userService;
    protected $roleService;

    public function __construct(
        UserService $userService,
        RoleService $roleService
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }
    /**
     * Выводит список всех пользователей
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->template = 'admin.user.index';
        $this->data['pageTitle'] = 'Пользователи';

        $this->data['users'] = $this->userService->getUsers();
        $this->data['roles'] = $this->roleService->getRoles();

        return $this->renderOut();
    }

    /**
     * Добавление нового пользователя
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData['email'] = $request->email;
        $userData['password'] = bcrypt($request->password);
        $userData['role_id'] = $request->role;

        $this->userService->createUser($userData);

        return redirect()->route('admin.users.index')->with('Пользователь добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
