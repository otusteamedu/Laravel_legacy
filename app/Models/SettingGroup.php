<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings() {
        return $this->hasMany('App\Models\Setting', 'group_id');
    }
}
