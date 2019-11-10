<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string photo
 * @property string role
 * @property string remember_token
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class User extends Authenticatable {

    use Notifiable;

    const ADMIN_ROLE = 'admin';
    CONST EDITOR_ROLE = 'editor';


    protected $fillable = ['name', 'email', 'password', 'photo', 'role'];
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

    public function isAdmin() {
       return $this->role === self::ADMIN_ROLE;
    }

    public function isEditor() {
        if ($this->isAdmin()) {
            return true;
        }
        return $this->role === self::EDITOR_ROLE;
    }

}
