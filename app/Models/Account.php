<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Model
 *
 * @property int id
 * @property string name
 * @property string surname
 * @property string family
 * @property string url_avatar
 * @property int status
 * @property int level_access
 * @property Carbon created_at
 * @property Carbon update_at
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Account query()
 * @mixin \Eloquent
 *
 */

class Account extends Model
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const LEVEL_ACCOUNT = 10;
    const LEVEL_MODERATOR = 20;
    const LEVEL_ADMIN = 1;


    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isAdmin(): bool
    {
        return $this->level_access === self::LEVEL_ADMIN;
    }

    public function isModerator(): bool
    {
        return $this->level_access === self::LEVEL_MODERATOR;
    }

}
