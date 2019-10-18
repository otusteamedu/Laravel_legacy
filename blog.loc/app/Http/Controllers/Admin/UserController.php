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
        $res = $user = $this->userService->getUserById($id);

        if($res === false) {
            return redirect()->route('admin.users.index')->with('error', 'Возникла ошибка');
        }

        $this->data['user'] = $user;
        $this->data['roles'] = $this->roleService->getRoles();

        $this->template = 'admin.user.show';
        $this->data['pageTitle'] = 'Пользователь: ' . $user->email;

        return $this->renderOut();
    }

    /**
     * Удаление пользователя
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $userId = $request->id;
        $res = $this->userService->destroy($userId);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

        return redirect()->route('admin.users.index')->with('success', 'Пользователь удален');
    }

    /**
     * Активация пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active(Request $request)
    {
        $userId = $request->id;
        $res = $this->userService->activate($userId);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

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
        $res = $this->userService->unactivate($userId);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

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

        $res = $this->userService->editFirstName($userId, $firstName);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

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

        $res = $this->userService->editLastName($userId, $lastName);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

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

        $res = $this->userService->editBirthday($userId, $birthday);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

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

        $res = $this->userService->editRole($userId, $roleId);

        if($res === false) {
            return redirect()->back()->with('error', 'Возникла ошибка');
        }

        return redirect()->back()->with('success', 'Пользователь изменен');
    }
}
