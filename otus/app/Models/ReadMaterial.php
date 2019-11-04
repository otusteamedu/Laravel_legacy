<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReadMaterial
 * @property User user_id
 * @property Material material_id
 * @package App\Models
 */
class ReadMaterial extends Model {
    protected $table = 'read_material';
    protected $fillable = ['user_id', 'material_id'];
    public $timestamps = false;
}
