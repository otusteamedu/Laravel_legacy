<?php

namespace App\Http\Handlers\News;

use App\Models\News;

class DeleteNewsHandler{

    public function handle(News $news){
        $news->delete();
    }
}