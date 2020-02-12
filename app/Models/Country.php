<?php

namespace App\Models;

/**
 * Class Country
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property integer created_by_user_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Country extends BaseModel
{
    protected $fillable = [
        'name',
        'created_by_user_id',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
