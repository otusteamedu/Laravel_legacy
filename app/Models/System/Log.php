<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    public function push_event()
    {
        return $this->belongsTo(Push_event::class);
    }

    protected $fillable = [
        'id',
        'time',
        'duration',
        'ip',
        'url',
        'method',
        'input',
    ];
}
