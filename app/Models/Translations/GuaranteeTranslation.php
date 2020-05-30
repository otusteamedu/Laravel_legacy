<?php

namespace App\Models\Translations;

/**
 * App\Models\Translations\GuaranteeTranslation
 *
 * @property int $id
 * @property int $guarantee_id
 * @property string $attribute
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereGuaranteeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereValue($value)
 * @mixin \Eloquent
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translations\GuaranteeTranslation whereLocale($value)
 */
class GuaranteeTranslation extends Translation
{
    protected $fillable = [
        'guarantee_id',
        'locale',
        'attribute',
        'value'
    ];
}
