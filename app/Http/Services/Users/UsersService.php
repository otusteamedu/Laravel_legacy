<?php

namespace App\Http\Services\Users;

use App\Http\Handlers\Users\CreateUsersHandler;
use App\Http\Handlers\Users\DeleteUsersHandler;
use App\Http\Handlers\Users\UpdateUsersHandler;
use App\Http\Repositories\Roles\RolesRepository;
use App\Http\Repositories\Users\Cache\CacheUsersRepository;
use App\Http\Repositories\Users\UsersRepository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersService{

    protected $usersRepository;
    protected $rolesRepository;

    protected $createUsersHandler;
    protected $updateUsersHandler;
    protected $deleteUsersHandler;
    protected $cacheUsersRepository;

    public function __construct(
        CreateUsersHandler $createUsersHandler,
        DeleteUsersHandler $deleteUsersHandler,
        UpdateUsersHandler $updateUsersHandler,
        UsersRepository $usersRepository,
        RolesRepository $rolesRepository,
        CacheUsersRepository $cacheUsersRepository
    ){
        $this->createUsersHandler = $createUsersHandler;
        $this->updateUsersHandler = $updateUsersHandler;
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
        $this->deleteUsersHandler = $deleteUsersHandler;
        $this->cacheUsersRepository = $cacheUsersRepository;
    }

    public function getUsersFromUser(){
        if(Auth::check()){
            $roleAuth = Auth::user()->role->type;
        }
        switch ($roleAuth) {
            case Role::LEVEL_ROOT:
                $result = $this->usersRepository->getUserFromRoot(CacheUsersRepository::USER_PAGINATE_COUNT);
            break;
            default:
                $result = $this->cacheUsersRepository->getUserFromAdmin();
            break;
        }

        return $result;
    }

    public function getRoleFromUser(){
        $result = $this->rolesRepository->getRoleFromUser();
        
        return $result;
    }

    public function searchParamUsers(string $field, string $value){
        $result = $this->usersRepository->searchParamUsers($field, $value);
        return $result;
    }

    public function createUser(array $data){
        $result = $this->createUsersHandler->handle($data);
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

    public function clearAdminUserCache(){
        $this->cacheUsersRepository->clearAdminUserCache();
    }

}
