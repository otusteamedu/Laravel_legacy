<?php

namespace App\Http\Controllers\Portal\User;

use App\Http\Controllers\Controller;
use App\Services\Portal\User\UsersService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** @var UsersService  */
    protected $usersService;

    /**
     * UserController constructor.
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function show(Request $request)
    {
        return view('portal.user.index');
    }

    public function edit(Request $request)
    {
        return view('portal.user.edit');
    }

    public function update(Request $request)
    {

    }

    public function changePassword(Request $request)
    {
        return view('portal.user.change_password');
    }

    public function updatePassword(Request $request)
    {

    }
}
