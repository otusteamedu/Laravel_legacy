<?php

namespace App\Http\Handlers\Users;

use App\Models\User;

class UpdateUsersHandler{

    public function handle(User $user, array $data){
        $user->update($data);
    }
}