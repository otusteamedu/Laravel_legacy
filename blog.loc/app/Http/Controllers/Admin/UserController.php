<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends MainController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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

        return $this->renderOut();
    }

    public function store(StoreUserRequest $request)
    {
        dd($request->all());
//        $userData = [];
//        $userData
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
