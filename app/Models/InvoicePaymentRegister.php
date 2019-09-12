<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoicePaymentRegister
 * @package App\Models
 * @property int $id
 * @property int $invoice_id
 * @property int $amount
 * @property Invoice $invoice
 */
class InvoicePaymentRegister extends Model
{
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
