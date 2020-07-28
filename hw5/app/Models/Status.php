<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models
 * @property int id
 * @property string name
 * @property timestamp created_at
 * @property timestamp updated_id
 */

class Status extends Model
{
    protected $fillable = [
        'name',
    ];
    public function tasks(){
        return $this->hasMany('App\Models\Task', 'status_id', 'id');
    }
}
