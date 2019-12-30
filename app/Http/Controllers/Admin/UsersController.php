<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\Users\UsersService;
use Illuminate\Http\Request;

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
     * @param UsersService $service
     * @return string
     */
    public function index(UsersService $service)
    {
        return $this->usersService->getUsersList();
    }


    /**
     * @param int $id
     * @return string
     */
    public function getUser(int $id)
    {
        return $this->usersService->getUserById($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
