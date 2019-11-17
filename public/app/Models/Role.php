<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const CLIENT = 'client';
}
