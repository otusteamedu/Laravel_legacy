<?php

namespace App\Models;

/**
 * App\Models\CategoryGroup
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryGroup whereNameRu($value)
 */
class CategoryGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_ru',
        'position'
    ];
}
