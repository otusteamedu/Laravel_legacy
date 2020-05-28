<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = ["name", "image", "weight"];

    public function exercise() {
        return $this->belongsToMany(App\Models\Exercise::class);
    }
}
