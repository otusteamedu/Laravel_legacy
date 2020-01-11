<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function settings() {
        return $this->hasMany('App\Models\Setting', 'group_id');
    }
}
