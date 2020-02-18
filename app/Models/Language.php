<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string $code
 * @property int|null $country_id
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language withoutTrashed()
 * @mixin \Eloquent
 */
class Language extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'country_id',
    ];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class)->get();
    }
}
