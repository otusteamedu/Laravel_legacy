<?php

namespace Sdav\ActivityLog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ActivityLog
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $url
 * @property string $method
 * @property string|null $params
 * @property int $status
 * @property int $duration
 * @property string $ip
 * @property string|null $agent
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ActivityLog extends Model
{
    protected $table = 'activity_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'method',
        'ip',
        'agent',
        'user_id',
        'duration',
        'params',
        'status'
    ];

}
