<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorMaterial
 * @property int id
 * @property Material material_id
 * @property Author author_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class AuthorMaterial extends Model {
    protected $fillable = ['author_id', 'material_id'];
    public $timestamps = false;
}
