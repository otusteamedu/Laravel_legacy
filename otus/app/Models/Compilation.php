<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compilation
 * @property int id
 * @property Material material_id
 * @property Compilation compilation_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Compilation extends Model {
    protected $fillable = ['material_id', 'compilation_id'];
    protected $with = ['material', 'compilation'];

    public function material() {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }

    public function compilation() {
        return $this->hasOne(SelectionMaterial::class, 'id', 'compilation_id');
    }
}
