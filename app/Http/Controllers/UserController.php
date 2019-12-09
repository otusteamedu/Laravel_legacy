<?php

namespace App\Http\Controllers;

use App\Models\User;

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
}
