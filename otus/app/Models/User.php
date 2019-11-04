<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @property int id
 * @property string name
 * @property string email
 * @property string password_hash
 * @property string photo
 * @property string remember_token
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class User extends Model {
    protected $fillable = ['name', 'email', 'password_hash', 'photo'];
    protected $with = ['favorites', 'reviews'];

    public function readMaterials() {
        return $this->belongsToMany(User::class, 'read_material', 'user_id', 'material_id');
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
