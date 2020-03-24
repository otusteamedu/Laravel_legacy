<?php

namespace App\Models;



/**
 * App\Models\Mtype
 *
 * @property int $id
 * @property string $name
 * @property string $fake
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype whereFake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mtype whereName($value)
 * @mixin \Eloquent
 */
class Mtype extends BaseModel
{
    public $timestamps = false;
}
