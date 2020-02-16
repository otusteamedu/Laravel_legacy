<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function news()
    {
        return $this->hasOne('App\Models\News');
    }
}
