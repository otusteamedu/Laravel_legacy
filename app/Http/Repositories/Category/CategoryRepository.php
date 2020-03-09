<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\CoreRepository;
use App\Models\Catalog\Category AS Model;

class CategoryRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getParentCategory(){
        return $this->startConditions()
                    ->with('children')
                    ->where('parent_id', 0)
                    ->get();
    }
}
