<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Events\Models\Task\TaskSaved;
use App\Services\Events\Models\Task\TaskDeleted;


/**
 * Class Task
 * @package App\Models
 * @property int id
 * @property string title
 * @property text description
 * @property int status_id Reference to Status.id
 * @property int user_id Reference to Users.id
 * @property timestamp do_date
 * @property int priority
 * @property timestamp created_at
 * @property timestamp updated_id
 */
class Task extends Model
{
    protected $fillable = [
        'id', 'title','description','status_id','user_id','priority'
    ];
    protected $dispatchesEvents = [
        'saved' => TaskSaved::class,
        'deleted' => TaskDeleted::class
    ];
}
