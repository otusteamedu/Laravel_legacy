<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Mpoll
 *
 * @property int $id
 * @property string|null $name
 * @property string $created
 * @property string|null $modified
 * @property int|null $mstatus_id
 * @property int|null $mtype_id
 * @property string|null $starttime Surveyee start
 * @property string|null $endtime Surveyee end time
 * @property float $price
 * @property string|null $description
 * @property int|null $click Clicks counter
 * @property int|null $repeatable Can user click more times
 * @property int|null $country_id
 * @property string|null $length Polls (projects)
 * @property int|null $survlimit Surveyee limit
 * @property string|null $prescreener prescreener
 * @property string|null $singleLink
 * @property string|null $filename mlinks source file
 * @property string|null $key CrKey
 * @property int|null $incabinet Show in cabinet Yes - 1 | 0 - No
 * @property string|null $cab_link link in cabunet XXX in the end
 * @property string|null $cab_price shwo that price in cabinet
 * @property int|null $completes Total completed
 * @property int|null $overquotas Total got overquotas
 * @property int|null $screenout Total screenout
 * @property int|null $mail_id
 * @property int|null $check_geo 1- check; 0 - no;
 * @property int|null $customer_id Cint, fed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCabLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCabPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCheckGeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereClick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCompletes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereEndtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereIncabinet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereMailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereMstatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereMtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereOverquotas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll wherePrescreener($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereRepeatable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereScreenout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereSingleLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereStarttime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereSurvlimit($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mpoll onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Mpoll whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mpoll withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Mpoll withoutTrashed()
 */
class Mpoll extends BaseModel
{
    /*const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';*/
    //
    use SoftDeletes;
    protected $fillable = [
        'created_at',
        'updated_at',
        'value',
        'name',
        'description',
        'country_id',
        'price',
        'created_user_id'
    ];
//    protected $guarded = [];

    public function quotas()
    {
        return $this->belongsToMany(Quota::class)
            ->withPivot('completes', 'sent')
            ->withTimestamps()
            ;
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

}
