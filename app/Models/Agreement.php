<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    const STATUS_ACTIVE = "active";
    const STATUS_NEW    = "new";
    const STATUS_OLD    = "old";

    public function version_owner_user() {
        return $this->hasOne(User::class, "version_owner_user_id");
    }

    public function members() {
        return $this->belongsToMany(User::class)
            ->using(AgreementUser::class)
            ->withPivot('is_owner', "status", "rejected_reason")
            ->withTimestamps();
    }

    public function points() {
        return $this->hasMany(Point::class);
    }

    public function penalties() {
        return $this->hasMany(Penalty::class);
    }

    public function journal() {
        return $this->hasMany(Journal::class);
    }
}
