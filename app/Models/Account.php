<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const DISCOUNT_COEFFICIENT_MIN=0.3;
    const DISCOUNT_COEFFICIENT_MAX=0.5;
}
