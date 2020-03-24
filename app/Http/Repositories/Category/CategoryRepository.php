<?php

namespace App\Http\Repositories\Category;

use App\Http\Repositories\CoreRepository;
use App\Models\Catalog\Category AS Model;

class CategoryRepository extends CoreRepository
{

    const PAGINATE_COUNT = 10;

    protected function getModelClass(){
        return Model::class;
    }

    public function getParen(){
        $result = $this->getModel()
                        ->with('children')
                        ->where('parent_id', 0)
                        ->get();

        return $result;
    }

    public function getPaginate(){
        $result = $this->getModel()
                    ->paginate(self::PAGINATE_COUNT);

        return $result;

    }
}
