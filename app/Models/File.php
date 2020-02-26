<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function news()
    {
        return $this->hasOne('App\Models\News');
    }

    public function item()
    {
        return $this->hasOne('App\Models\Catalog\Item');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Catalog\Category');
    }
}
