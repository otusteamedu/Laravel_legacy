<?php

namespace App\Http\Handlers\Users;

use App\Http\Repositories\CoreRepository;
use App\Models\User AS Model;

class CreateUsersHandler extends CoreRepository{

    protected function getModelClass(){
        return Model::class;
    }

    public function handle(array $data){
        $result = $this->getModel()->create($data);
        return $result;
    }
}