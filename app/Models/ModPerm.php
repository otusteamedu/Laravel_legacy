<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModPerm extends Model
{
    //
    protected $table = "mod_perms";
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'access_id',
    ];
}
