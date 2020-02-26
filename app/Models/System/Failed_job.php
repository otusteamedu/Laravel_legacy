<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\Failed_job
 *
 * @property int $id
 * @property int $event_id
 * @property string|null $connection
 * @property string|null $queue
 * @property string|null $payload
 * @property string|null $exception
 * @property string $failed_at
 * @property-read \App\Models\System\Push_event $push_event
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Failed_job whereQueue($value)
 * @mixin \Eloquent
 */
class Failed_job extends Model
{
    public $timestamps = false;

    public function push_event()
    {
        return $this->belongsTo(Push_event::class);
    }

    protected $fillable = [
        'event_id',
        'connection',
        'queue',
        'payload',
        'failed_at',
    ];
}
