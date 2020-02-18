<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\EventPicture
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $event_id
 * @property int $picture_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture wherePictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture whereUpdatedAt($value)
 */
class EventPicture extends Pivot
{
}
