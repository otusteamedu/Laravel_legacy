<?php

namespace App\Http\Services\Roles;

use App\Http\Repositories\Roles\RolesRepository;

class RolesService 
{

    protected $rolesRepository;

    public function __construct(
        RolesRepository $rolesRepository
    ){
        $this->rolesRepository = $rolesRepository;
    }

    public function getRoles(){
        $result = $this->rolesRepository->getRoles();
        return $result;
    }

    public function getRole($field, $value){
        $result = $this->rolesRepository->getRoles($field, $value);

        return $result;
    }

    public function getRoleType(){
        $result = $this->rolesRepository->getRoleType();

        return $result;
    }
}
