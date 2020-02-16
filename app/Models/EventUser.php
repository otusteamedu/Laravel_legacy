<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\EventUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $is_successful
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereIsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventUser whereUserId($value)
 */
class EventUser extends Pivot
{
}
