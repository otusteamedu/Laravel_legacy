<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public function agreement() {
        return $this->belongsTo(Agreement::class);
    }
}
