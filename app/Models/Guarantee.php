<?php

namespace App\Models;

/**
 * App\Models\Guarantee
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Guarantee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Guarantee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
