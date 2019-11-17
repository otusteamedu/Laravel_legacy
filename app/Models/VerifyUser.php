<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];

    protected $fillable = ['token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
