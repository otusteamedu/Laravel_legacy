<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Construction
 * @package App\Model
 *
 * @property int id
 * @property string name
 * @property string description
 * @property string type_code
 * @property int created_account_id
 * @property Carbon created_at
 * @property Carbon update_at
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Construction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Construction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Construction query()
 * @mixin \Eloquent
 *
 */

class Construction extends Model
{
    protected $guarded = [];

    public function constructionType()
    {
        return $this->belongsTo(ConstructionType::class);
    }
}
