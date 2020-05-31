<?php

namespace App\Models\Planner;

use App\Models\BaseModel;

/**
 * App\Models\Planner\PlannerSocialNetworkAccount
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\PlannerSocialNetworkAccount whereUserId($value)
 * @mixin \Eloquent
 */
class PlannerSocialNetworkAccount extends BaseModel
{
    protected $fillable = [
        'login', 'password', 'user_id',
    ];

    protected $hidden = [];

    public function user(){
        $this->hasOne(\App\Models\User::class);
    }
}
