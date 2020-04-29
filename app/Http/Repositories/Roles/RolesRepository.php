<?php

namespace App\Http\Repositories\Roles;

use App\Http\Repositories\CoreRepository;
use App\Models\Role AS Model;

class RolesRepository extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }

    public function getRoleFromUser(){
        $result = $this->getModelClass()
                        ::where('type', '!=', $this->getModelClass()::LEVEL_ROOT)
                        ->get();

        return $result;
    }

    public function getRoles(){
        $result = $this->getModelClass()::all();

        return $result;
    }

    public function getRole($field, $value){
        $result = $this->getRoles()
                    ->where($field, $value)
                    ->first();

        return $result;           
    }

    public function getRoleType(){
        $roleResult = [];
        foreach($this->getRoles() AS $role){
            $roleResult[] = $role->type;
        }
        return $roleResult;
    }
}
