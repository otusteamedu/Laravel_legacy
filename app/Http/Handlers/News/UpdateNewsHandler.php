<?php

namespace App\Http\Handlers\News;

use App\Models\News;

class UpdateNewsHandler{

    public function handle(News $news, array $data){
        $news->update($data);
    }
}