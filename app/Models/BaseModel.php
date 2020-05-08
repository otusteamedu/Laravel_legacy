<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

class BaseModel extends Model
{
    use Rememberable;
}
