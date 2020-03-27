<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 */
class EventType extends Model
{

}
