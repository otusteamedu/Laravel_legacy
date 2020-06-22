<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessType
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessType whereName($value)
 * @mixin \Eloquent
 */
class BusinessType extends Model
{
    public $fillable = [
        'id',
        'name',
        'description',
    ];

    public $timestamps = false;
}
