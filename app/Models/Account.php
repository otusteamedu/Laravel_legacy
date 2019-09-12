<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель счета
 * Class Account
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property float $amount
 * @property AccountTransaction[] $transactions
 */
class Account extends Model
{
    public function transactions()
    {
        return $this->hasMany(AccountTransaction::class);
    }
}
