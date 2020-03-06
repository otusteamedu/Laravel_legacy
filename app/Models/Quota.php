<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Quota
 *
 * @property int $id
 * @property int $country_id event id from CINT
 * @property int|null $mpoll_id
 * @property string $name
 * @property string $description
 * @property int|null $completes
 * @property int|null $over_quotas
 * @property int|null $screenout
 * @property string|null $created
 * @property string|null $modified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereCompletes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereMpollId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereOverQuotas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereScreenout($value)
 * @mixin \Eloquent
 */
class Quota extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    //
}
