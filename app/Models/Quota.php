<?php

namespace App\Models;



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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Quota whereUpdatedAt($value)
 */
class Quota extends BaseModel
{
    /*const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';*/
    //
    public function mpolls()
    {
        return $this->belongsToMany(Mpoll::class);
    }

}
