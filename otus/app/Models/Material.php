<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Material
 * @property int id
 * @property string name
 * @property Category category_id
 * @property Author authors_id
 * @property Handbook status_id
 * @property string file
 * @property \DateTime year_publishing
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Material extends Model {
    protected $fillable = ['name', 'category_id', 'status_id', 'file', 'year_publishing'];
    protected $with = ['category', 'authors','readUsers', 'status'];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function authors() {
        return $this->belongsToMany(Author::class, 'author_material', 'material_id', 'author_id');
    }

    public function readUsers() {
        return $this->belongsToMany(User::class, 'read_material', 'material_id', 'user_id');
    }

    public function status() {
        return $this->hasOne(Handbook::class, 'id', 'status_id');
    }
}
