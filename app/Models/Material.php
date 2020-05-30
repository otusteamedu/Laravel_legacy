<?php

namespace App\Models;

/**
 * App\Models\Material
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Material whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Material extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
