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
}
