<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserData
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserData whereUserId($value)
 * @mixin \Eloquent
 */
class UserData extends Model
{
    public $fillable = [
        'id',
        'user_id',
        'name',
        'surname',
        'middle_name',
        'created_at',
        'updated_at',
    ];

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
