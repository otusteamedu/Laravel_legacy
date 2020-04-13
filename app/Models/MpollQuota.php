<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\MpollQuota
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MpollQuota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MpollQuota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MpollQuota query()
 * @mixin \Eloquent
 */
class MpollQuota extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
