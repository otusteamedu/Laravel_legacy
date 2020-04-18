<?php

namespace App\Http\Handlers\Users;

use App\Models\User;

class DeleteUsersHandler{

    public function handle(User $user){
        $user->delete();
    }
}