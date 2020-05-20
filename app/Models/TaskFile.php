<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TaskFile
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ProjectTask $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskFile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskFile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskFile withoutTrashed()
 * @mixin \Eloquent
 */
class TaskFile extends Model
{
    use SoftDeletes;

    /**
     * Получить задачу к которой прикреплён файл
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(ProjectTask::class);
    }

    /**
     * Получить пользователя добавешего файл
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
