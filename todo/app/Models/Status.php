<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models
 * @property int id
 * @property string name
 */
class Status extends Model
{
    protected $table = 'statuses';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'status_id', 'id');
    }
}
