<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


/**
 * App\Models\Contract
 *
 * @property int $id
 * @property int $company_id
 * @property int $room_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stoped_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Price[] $prices
 * @property-read int|null $prices_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereStopedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Contract whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contract extends Pivot
{
    protected $table = 'contracts';

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
