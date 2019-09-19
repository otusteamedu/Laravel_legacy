<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Реестр счетов по л/с
 *
 * Class Invoice
 * @package App\Models
 * @property int $id
 * @property int $service_id
 * @property int $address_id
 * @property float $amount
 * @property string $status
 * @property InvoicePaymentRegister[]|Collection $payments
 */
class Invoice extends Model
{
    public function payments()
    {
        return $this->hasMany(InvoicePaymentRegister::class);
    }
}
