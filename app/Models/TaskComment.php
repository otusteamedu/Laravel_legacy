<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TaskComment
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ProjectTask $task
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TaskComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TaskComment withoutTrashed()
 * @mixin \Eloquent
 */
class TaskComment extends Model
{
    use SoftDeletes;

    /**
     * Получить задачу комментария
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(ProjectTask::class);
    }

    /**
     * Получить пользователя написавшего комментарий
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
