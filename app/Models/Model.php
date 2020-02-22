<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Watson\Rememberable\Rememberable;

class Model extends BaseModel
{
    use Rememberable;
}
