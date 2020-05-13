<?php

namespace App\Models;

use App\Helpers\FilesWork;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    const FILE_PATH = 'news/';
    
    protected $guarded = [];

    public function getFilePathAttribute()
    {
        if($this->file){
            $filePath = FilesWork::getPath(News::FILE_PATH, $this->id, $this->file);
        }
        return $filePath ?? '';
    }
}
