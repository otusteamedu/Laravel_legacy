<?php

namespace App\Http\Handlers\News;

use App\Job\Files\FilesJob;
use App\Models\News;

class UpdateNewsHandler{

    public function handle(News $news, array $data){
        FilesJob::dispatch($news);
        $news->update($data);
    }
}