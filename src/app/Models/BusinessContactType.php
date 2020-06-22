<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessContactType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessContactType whereName($value)
 * @mixin \Eloquent
 */
class BusinessContactType extends Model
{
    public $fillable = [
        'id',
        'name',
        'description',
    ];

    public $timestamps = false;
}
