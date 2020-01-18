<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pickedByUser()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['comment'])
            ->using(ItemUser::class);
    }
}
