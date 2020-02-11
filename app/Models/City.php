<?php

namespace App\Models;

/**
 * Class City
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property integer country_id
 * @property integer created_by_user_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class City extends BaseModel
{
    protected $fillable = [
        'name',
        'country_id',
        'created_by_user_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
