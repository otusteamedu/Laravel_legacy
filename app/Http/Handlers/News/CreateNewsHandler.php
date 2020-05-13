<?php

namespace App\Http\Handlers\News;

use App\Http\Repositories\CoreRepository;
use App\Job\Files\FilesJob;
use App\Models\News AS Model;

class CreateNewsHandler extends CoreRepository{

    protected function getModelClass(){
        return Model::class;
    }

    public function handle(array $data){
        $result = $this->getModel()->create($data);
        FilesJob::dispatch($result);
        return $result;
    }
}
