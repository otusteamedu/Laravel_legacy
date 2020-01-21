<?php

namespace App\Models;

/**
 * Class Item
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property string photo
 * @property string description
 * @property integer city_id
 * @property integer user_id
 * @property integer pick_user_id
 * @property boolean active
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Item extends BaseModel
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
