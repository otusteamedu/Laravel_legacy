<?php

namespace App\Models;

/**
 * App\Models\Color
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Color whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Color extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_ru'
    ];
}
