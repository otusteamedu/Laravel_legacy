<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['id','name','text','lessen_id','status'];
    protected $guarded = ['_method','_token'];
}
