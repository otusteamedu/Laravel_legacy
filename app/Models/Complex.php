<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    protected $fillable = ["name"];

    public function exercise() {
        return $this->belongsToMany(App\Models\Exercise::class);
    }

    public function comment() {
        return $this->hasMany(App\Models\Comment::class);
    }

    public function workout() {
        return $this->hasMany(App\Models\Workout::class);
    }
}
