<?php

namespace App\Models\Planner;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Planner\Post
 *
 * @property int $id
 * @property string $description
 * @property int $user_id
 * @property int|null $planner_geo_id
 * @property int|null $planner_soc_network_account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post wherePlannerGeoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post wherePlannerSocNetworkAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Planner\Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends BaseModel
{
    protected $table = 'planner_posts';

    protected $fillable = [
        'description',
        'user_id',
        'planner_geo_id',
        'planner_soc_network_account_id'
    ];

    public function user(){
        $this->hasOne('App\Models\User');
    }

    public function socNetworkAccount(){
        $this->hasOne(SocNetworkAccount::class);
    }
}
