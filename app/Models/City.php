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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
