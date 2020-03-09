<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    protected $guarded = [];
    
    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function specification()
    {
        return $this->belongsToMany(Specification::class);
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }
}
