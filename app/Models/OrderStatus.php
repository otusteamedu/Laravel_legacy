<?php

namespace App\Models;

/**
 * App\Models\OrderStatus
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereUpdatedAt($value)
 * @method \App\Models\OrderStatus nameRu($name)
 * @mixin \Eloquent
 * @property string|null $name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderStatus whereNameRu($value)
 */
class OrderStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_id',
        'position'
    ];
}
