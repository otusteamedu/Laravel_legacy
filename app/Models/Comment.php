<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["text"];

    public function user() {
        return $this->belongsTo(App\Models\User::class);
    }

    public function complex() {
        return $this->belongsTo(App\Models\Complex::class);
    }
}
