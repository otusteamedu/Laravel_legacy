<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\FailedJob
 *
 * @property int $id
 * @property int $event_id
 * @property string|null $connection
 * @property string|null $queue
 * @property string|null $payload
 * @property string|null $exception
 * @property string $failed_at
 * @property-read \App\Models\System\Push_event $push_event
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\FailedJob whereQueue($value)
 * @mixin \Eloquent
 */
class FailedJob extends Model
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
