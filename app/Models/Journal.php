<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    const STATUS_CONFIRMED = "active";
    const STATUS_REJECTED  = "old";
    const STATUS_NEW       = "new";

    public function declare_user() {
        return $this->belongsTo(User::class, "declare_user_id");
    }

    public function penalty_user() {
        return $this->belongsTo(User::class, "penalty_user_id");
    }

    // штраф, который должен быть исполнен
    public function penalty() {
        return $this->belongsTo(Penalty::class);
    }

    // штраф, который должен быть исполнен
    public function agreement() {
        return $this->belongsTo(Agreement::class);
    }
}
