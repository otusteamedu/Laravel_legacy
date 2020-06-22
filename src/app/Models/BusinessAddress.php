<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessAddress
 *
 * @property int $id
 * @property int $business_id
 * @property string $address
 *
 * @property-read \App\Models\Business|null $business
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessAddress whereId($value)
 * @mixin \Eloquent
 */
class BusinessAddress extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'address',
    ];

    public $timestamps = false;

    /**
     * Business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class);
    }
}
