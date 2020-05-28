<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ["name", "image", "description"];

    public function equipment() {
        return $this->belongsToMany(App\Models\Equipment::class);
    }

    public function user() {
        return $this->belongsTo(App\Models\User::class);
    }

    public function complex() {
        return $this->belongsToMany(App\Models\Complex::class);
    }
}
