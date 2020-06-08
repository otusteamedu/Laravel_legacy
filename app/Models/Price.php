<?php

namespace App\Models;



/**
 * App\Models\Price
 *
 * @property int $id
 * @property int $contract_id
 * @property float $price
 * @property float $price_fix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stoped_at
 * @property-read \App\Models\Contract $contract
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price wherePriceFix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price whereStopedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Price whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Price extends ModelBase
{

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }



}
