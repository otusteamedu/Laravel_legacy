<?php

namespace App\Http\Repositories\Users;

use App\Http\Repositories\CoreRepository;
use App\Models\Role;
use App\Models\User AS Model;

class UsersRepository extends CoreRepository
{

    const PAGINATE_COUNT = 10;

    protected function getModelClass(){
        return Model::class;
    }

    public function getUserFromAdmin(){
        $result = 
        $this->getModelClass()::whereHas('role', function($q){
                $q->where('type', Role::LEVEL_USER);
            })->paginate(self::PAGINATE_COUNT);

        return $result;
    }

    public function getUserFromRoot(){
        $result = 
        $this->getModelClass()::whereHas('role', function($q){
                $q->where('type', '!=', Role::LEVEL_ROOT);
            })->paginate(self::PAGINATE_COUNT);

        return $result;
    }
}
