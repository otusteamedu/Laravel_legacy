<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProjectTask
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectTask onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectTask whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectTask withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProjectTask withoutTrashed()
 * @mixin \Eloquent
 */
class ProjectTask extends Model
{
    use SoftDeletes;

    const STATUS_NEW = 'new';
    const STATUS_PROCESS = 'process';
    const STATUS_PAUSE = 'pause';
    const STATUS_READY = 'ready';
    const STATUS_FINISHED = 'finished';

    protected $fillable = ['title', 'description', 'project_id', 'user_id', 'status'];

    /**
     * Получить проект задачи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Получить пользователя задачи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
