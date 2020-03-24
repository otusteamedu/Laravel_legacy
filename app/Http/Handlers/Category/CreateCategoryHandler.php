<?php

namespace App\Http\Handlers\Category;

use App\Http\Repositories\CoreRepository;
use App\Models\Catalog\Category AS Model;

class CreateCategoryHandler extends CoreRepository{

    protected function getModelClass(){
        return Model::class;
    }

    public function handle(array $data){
        $category = $this->getModel()->create($data);
        return $category;
    }
}