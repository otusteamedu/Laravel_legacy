<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Requests\StoreUserRequest;
use App\Http\Controllers\Admin\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\Users\UsersService;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 */
class UsersController extends Controller
{

    /**
     * @var UsersService
     */
    private $usersService;

    /**
     * Get user list
     *
     * UsersController constructor.
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }


    /**
     * Возвращает список пользователей в формате json с пагинацией
     *
     * @return string
     */
    public function index()
    {
        return $this->usersService->getUsersList()->toJson();
    }


    /**
     * @param int $id
     * @return string
     */
    public function getUser(int $id)
    {
        return $this->usersService->getUserById($id)->toJson();
    }

    /**
     * Сохранения данных пользователя
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, User $user)
    {
        dd($user->update($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->getData();
        $result = $this->usersService->updateUserData($user, $data);
        return $result ? response('Success', 200) : response('Unsuccess', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
