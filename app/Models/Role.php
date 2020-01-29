<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 * @property int id
 * @property string title
 *
 */
class Role extends Model
{
    protected $fillable = [
        'id',
        'title',
    ];
}
