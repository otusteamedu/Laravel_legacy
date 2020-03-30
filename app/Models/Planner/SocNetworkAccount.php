<?php

namespace App\Models\Planner;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Planner\SocNetworkAccount
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Planner\SocNetworkAccount whereUserId($value)
 * @mixin \Eloquent
 */
class SocNetworkAccount extends BaseModel
{
    protected $table = 'planner_soc_network_accounts';

    protected $fillable = [
        'login', 'password', 'user_id',
    ];

    protected $hidden = [];

    public function user(){
        $this->hasOne('App\Models\User');
    }
}
