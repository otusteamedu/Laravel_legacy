<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *
     *
     */
    public function showList()
    {
        $usersList = User::simplePaginate(15);

        return view('users.show-list', [
            'usersList' => $usersList
        ]);
    }

    /**
     *
     *
     */
    public function showUserPage()
    {
        $user = Auth::user();

        return view('users.user-page', [
            'user' => $user
        ]);
    }
}
