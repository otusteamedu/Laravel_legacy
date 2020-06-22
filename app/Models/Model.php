<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as ModelBase;
use App\Models\Traits\GetPage;

/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model query()
 * @mixin \Eloquent
 */
class Model extends ModelBase
{
    use GetPage;
}
