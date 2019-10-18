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

        return redirect()->route('admin.users.index')->with('success', 'Пользователь добавлен');
    }

    /**
     * Просмотр информации о пользователе
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        $this->data['user'] = $user;
        $this->data['roles'] = $this->roleService->getRoles();

        $this->template = 'admin.user.show';
        $this->data['pageTitle'] = 'Пользователь: ' . $user->email;

        return $this->renderOut();
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

    /**
     * Активация пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active(Request $request)
    {
        $userId = $request->id;
        $this->userService->activate($userId);

        return redirect()->back()->with('success', 'Пользователь активирован');
    }

    /**
     * Деактивация пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unactive(Request $request)
    {
        $userId = $request->id;
        $this->userService->unactivate($userId);

        return redirect()->back()->with('success', 'Пользователь деактивирован');
    }

    /**
     * Редатирование имени пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editFirstName(Request $request)
    {
        $userId = $request->id;
        $firstName = $request->first_name;

        $this->userService->editFirstName($userId, $firstName);

        return redirect()->back()->with('success','Пользователь изменен');
    }

    /**
     * Редактирование фамилии пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editLastName(Request $request)
    {
        $userId = $request->id;
        $lastName = $request->last_name;

        $this->userService->editLastName($userId, $lastName);

        return redirect()->back()->with('success', 'Пользователь изменен');
    }

    /**
     * Редактирование дня рождения
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editBirthday(Request $request)
    {
        $userId = $request->id;
        $birthday = $request->birthday;

        $this->userService->editBirthday($userId, $birthday);

        return redirect()->back()->with('success', 'Пользователь изменен');
    }

    /**
     * Редактирование роли пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editRole(Request $request)
    {
        $userId = $request->id;
        $roleId = $request->role;

        $this->userService->editRole($userId, $roleId);

        return redirect()->back()->with('success', 'Пользователь изменен');
    }
}
