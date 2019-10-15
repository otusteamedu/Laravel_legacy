<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @property int id
 * @property string name
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Category extends Model {
    protected $fillable = ['name'];
}
