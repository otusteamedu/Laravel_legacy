<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function country() {
        return $this->hasOne('App\Models\Country','id', 'country_id');
    }
    public function orgBranch() {
        return $this->hasOne('App\Models\orgBranch','id', 'org_branch_id');
    }
    public function orgGroup() {
        return $this->hasOne('App\Models\orgGroup','id', 'org_group_id');
    }
    public function orgType() {
        return $this->hasOne('App\Models\orgType','id', 'org_type_id');
    }
}
