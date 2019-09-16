<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App\Models
 * @property int $id
 * @property string $address
 * @property string $owner_name
 * @property string $number
 * @property float $balance
 * @property Invoice[]|Collection $invoices
 */
class Address extends Model
{
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
