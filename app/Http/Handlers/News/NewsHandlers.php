<?php

namespace App\Http\Handlers\News;

use App\Http\Repositories\CoreRepository;
use App\Models\News AS Model;
use Illuminate\Http\Request;

class NewsHandlers extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }

    public function storeData(Request $request){
        $this->getModel()->create($request->all());
    }

    public function updateData(Model $news, Request $request){
        $news->update($request->all());
    }

    public function destroyData(Model $news){
        $news->delete();
    }
}
