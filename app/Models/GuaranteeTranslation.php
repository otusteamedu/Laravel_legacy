<?php

namespace App\Models;

/**
 * App\Models\GuaranteeTranslation
 *
 * @property int $id
 * @property int $guarantee_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereGuaranteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GuaranteeTranslation whereLocale($value)
 */
class GuaranteeTranslation extends Model
{
    protected $fillable = [
        'guarantee_id',
        'locale',
        'attribute',
        'value'
    ];
}
