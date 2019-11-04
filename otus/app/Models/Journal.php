<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Journal
 * @property int id
 * @property User user_id
 * @property Handbook status_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @package App\Models
 */
class Journal extends Model {

    protected $fillable = ['user_id', 'status_id'];
    protected $with = ['user', 'status'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function status() {
        return $this->hasOne(Handbook::class, 'id', 'status_id');
    }
}
