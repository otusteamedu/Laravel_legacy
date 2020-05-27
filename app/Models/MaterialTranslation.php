<?php

namespace App\Models;

/**
 * App\Models\MaterialTranslation
 *
 * @property int $id
 * @property int $material_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MaterialTranslation whereValue($value)
 * @mixin \Eloquent
 */
class MaterialTranslation extends Model
{
    protected $fillable = [
        'material_id',
        'attribute',
        'value'
    ];
}
