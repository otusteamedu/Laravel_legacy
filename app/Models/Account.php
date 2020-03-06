<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accaunt
 * @package App\Model
 *
 * @property int id
 * @property string name
 * @property int status
 * @property Carbon created_at
 * @property Carbon update_at
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accaunt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accaunt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Accaunt query()
 * @mixin \Eloquent
 *
 */

class Account extends Model
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 10;

    public function users()
    {
        return $this->hasMany(User::class);
    }



}
