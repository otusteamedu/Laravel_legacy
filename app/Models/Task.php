<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App\Models
 * @property int id
 * @property int project_id
 * @property string name
 * @property string description
 * @property  int user_id
 *
 */
class Task extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'name',
        'description',
        'user_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
