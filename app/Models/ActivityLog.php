<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ActivityLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog query()
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog whereStatus($value)
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
