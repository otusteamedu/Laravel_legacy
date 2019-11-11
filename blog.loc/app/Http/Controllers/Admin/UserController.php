<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $data['pageTitle'] = 'Пользователи';
        try {
            $data['users'] = $this->userService->getUsers();
            $data['roles'] = $this->roleService->getRoles();

            return view('admin.user.index')->with($data);
        } catch (\Exception $e) {
            report($e);

            return view('admin.user.index',$data)->withErrors('Возникла ошибка.');
        }
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
        try {
            $this->userService->createUser($userData);

            return redirect()->route('admin.users.index')->with('success', 'Пользователь добавлен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->route('admin.users.index')->with('error', 'Возникла ошибка.');
        }
    }

    /**
     * Просмотр информации о пользователе
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);
            $data['user'] = $user;
            $data['roles'] = $this->roleService->getRoles();
            $this->template = 'admin.user.show';
            $data['pageTitle'] = 'Пользователь: ' . $user->email;

            return view('admin.user.show')->with($data);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.users.index')->with('error', 'Возникла ошибка: Пользователь не найден');
        } catch (\Exception $e) {
            report($e);

            return redirect()->route('admin.users.index')->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Удаление пользователя
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $userId = $request->id;
            $this->userService->destroy($userId);

            return redirect()->route('admin.users.index')->with('success', 'Пользователь удален');
        } catch (\Exception $e) {
            report($e);

            return redirect()->route('admin.users.index')->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Активация пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active(Request $request)
    {
        $userId = $request->id;
        try {
            $this->userService->activate($userId);

            return redirect()->back()->with('success', 'Пользователь активирован');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Деактивация пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unactive(Request $request)
    {
        try {
            $userId = $request->id;
            $this->userService->unactivate($userId);

            return redirect()->back()->with('success', 'Пользователь деактивирован');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Редатирование имени пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editFirstName(Request $request)
    {
        try {
            $userId = $request->id;
            $firstName = $request->first_name;
            $this->userService->editFirstName($userId, $firstName);

            return redirect()->back()->with('success', 'Пользователь изменен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Редактирование фамилии пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editLastName(Request $request)
    {
        try {
            $userId = $request->id;
            $lastName = $request->last_name;
            $this->userService->editLastName($userId, $lastName);

            return redirect()->back()->with('success', 'Пользователь изменен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Редактирование дня рождения
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editBirthday(Request $request)
    {
        try {
            $userId = $request->id;
            $birthday = $request->birthday;
            $this->userService->editBirthday($userId, $birthday);

            return redirect()->back()->with('success', 'Пользователь изменен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }

    /**
     * Редактирование роли пользователя
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editRole(Request $request)
    {
        try {
            $userId = $request->id;
            $roleId = $request->role;
            $this->userService->editRole($userId, $roleId);

            return redirect()->back()->with('success', 'Пользователь изменен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }

    }

    /**
     * Редактирование пароля
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $userId = $request->id;
            $newPassword = $request->password;
            $this->userService->changePassword($userId, $newPassword);

            return redirect()->back()->with('success', 'Пользователь изменен');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Возникла ошибка');
        }
    }
}
