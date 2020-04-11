<?php

namespace App\Models;

use App\Models\Model;

/**
 * App\Models\EventType
 *
 * @property int $id
 * @property string $name
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventType withoutTrashed()
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereUpdatedAt($value)
 */
class EventType extends Model
{

}
