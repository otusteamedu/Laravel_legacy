<?php

namespace App\Http\Services\Users;

use App\Http\Handlers\Users\DeleteUsersHandler;
use App\Http\Handlers\Users\UpdateUsersHandler;
use App\Http\Repositories\Roles\RolesRepository;
use App\Http\Repositories\Users\UsersRepository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersService{

    protected $usersRepository;
    protected $rolesRepository;
    protected $updateUsersHandler;
    protected $deleteUsersHandler;

    public function __construct(
        DeleteUsersHandler $deleteUsersHandler,
        UpdateUsersHandler $updateUsersHandler,
        UsersRepository $usersRepository,
        RolesRepository $rolesRepository
    ){
        $this->updateUsersHandler = $updateUsersHandler;
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
        $this->deleteUsersHandler = $deleteUsersHandler;
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

    public function getRoleFromUser(){
        $result = $this->rolesRepository->getRoleFromUser();
        
        return $result;
    }

    public function updateUser(User $user, array $data){
        $result = $this->updateUsersHandler->handle($user, $data);
        return $result;
    }

    public function deleteUser(User $user){
        $result = $this->deleteUsersHandler->handle($user);
        return $result;
    }

}
