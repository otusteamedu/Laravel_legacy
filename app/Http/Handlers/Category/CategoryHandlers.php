<?php

namespace App\Http\Handlers\Category;

use App\Http\Repositories\CoreRepository;
use App\Models\Catalog\Category AS Model;
use Illuminate\Http\Request;

class CategoryHandlers extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }

    public function storeData(Request $request){
        $this->startConditions()->create($request->all());
    }

    public function updateData(Model $category, Request $request){
        $category->update($request->all());
    }

    public function destroyData(Model $category){
        $category->delete();
    }
}
