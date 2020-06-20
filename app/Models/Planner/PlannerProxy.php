<?php

namespace App\Models\Planner;

use App\Models\BaseModel;

/**
 * App\Models\Planner\PlannerPost
 *
 * @property int $id
 * @property string $description
 * @property int $user_id
 * @property int|null $planner_geo_id
 * @property int|null $planner_social_network_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost wherePlannerGeoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost wherePlannerSocialNetworkAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerPost whereUserId($value)
 * @mixin \Eloquent
 */
class PlannerProxy extends BaseModel
{
    protected $fillable = [
        'ip',
        'type',
        'ip',
        'port',
        'login',
        'password',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
