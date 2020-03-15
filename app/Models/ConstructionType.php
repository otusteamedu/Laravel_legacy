<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConstructionType
 * @package App\Model
 *
 * @property int id
 * @property string name
 * @property string description
 * @property string code
 *
 * @property int created_account_id
 * @property Carbon created_at
 * @property Carbon update_at
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConstructionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConstructionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConstructionType query()
 * @mixin \Eloquent
 *
 */

class ConstructionType extends Model
{
    protected $guarded = [];

    public function construction()
    {
        return $this->hasMany(Construction::class);
    }
}
