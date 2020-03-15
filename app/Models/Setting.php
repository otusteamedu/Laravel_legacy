<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Model
 *
 * @property int id
 * @property int created_account_id
 * @property array data
 * @property Carbon created_at
 * @property Carbon update_at
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @mixin \Eloquent
 *
 */

class Setting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => "array",
    ];

    public function Account(){

        return $this->hasOne('App\Models\Account','id','created_account_id');
    }
}
