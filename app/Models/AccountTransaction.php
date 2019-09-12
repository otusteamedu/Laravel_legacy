<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Реестр транзакций по счету
 * Class AccountTransaction
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property int $counterparty_id
 * @property string $comment
 * @property float $amount
 * @property Account $account
 * @property Counterparty|null $counterparty
 */
class AccountTransaction extends Model
{
    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function counterparty()
    {
        return $this->hasOne(Counterparty::class);
    }
}
