<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\PushEvent
 *
 * @property int $id
 * @property string $name
 * @property string $condition
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\PushEvent whereName($value)
 * @mixin \Eloquent
 */
class PushEvent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'condition',
        'created_at',
    ];
}
