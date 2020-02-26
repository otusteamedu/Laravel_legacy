<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\Push_event
 *
 * @property int $id
 * @property string $name
 * @property string $condition
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\System\Push_event whereName($value)
 * @mixin \Eloquent
 */
class Push_event extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'condition',
        'created_at',
    ];
}
