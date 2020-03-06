<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Mstatus
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mstatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mstatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mstatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mstatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mstatus whereName($value)
 * @mixin \Eloquent
 */
class Mstatus extends Model
{
    public $timestamps = false;
}
