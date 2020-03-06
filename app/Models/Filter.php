<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Filter
 *
 * @property int $id
 * @property int $filter_type_id event id from CINT
 * @property int $quota_id event id from CINT
 * @property string $name
 * @property string $value
 * @property string $description
 * @property string|null $created
 * @property string|null $modified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereFilterTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereQuotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Filter whereValue($value)
 * @mixin \Eloquent
 */
class Filter extends Model
{
    public $timestamps = false;
}
