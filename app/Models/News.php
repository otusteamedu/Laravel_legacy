<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    protected $guarded = [];

    public function file()
    {
        return $this->belongsTo('App\Models\File');
    }
}
