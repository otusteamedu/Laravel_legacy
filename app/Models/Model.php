<?php

namespace App\Models;

use Watson\Rememberable\Rememberable;
use \Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    use Rememberable;
}
