<?php

namespace App\Http\Services\Users;

use App\Http\Repositories\Users\UsersRepository;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UsersService{

    protected $usersRepository;

    public function __construct(
        UsersRepository $usersRepository
    ){
        $this->usersRepository = $usersRepository;
    }

    public function getUsersFromUser(){
        if(Auth::check()){
            $roleAuth = Auth::user()->role->type;
        }
        switch ($roleAuth) {
            case Role::LEVEL_ROOT:
                $result = $this->usersRepository->getUserFromRoot();
            break;
            default:
                $result = $this->usersRepository->getUserFromAdmin();
            break;
        }
        return $result;
    }


}
