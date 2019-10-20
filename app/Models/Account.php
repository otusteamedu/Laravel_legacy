<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель счета
 * Class Account.
 *
 * @property int                             $id
 * @property string                          $title
 * @property float                           $amount
 * @property AccountTransaction[]|Collection $transactions
 */
class Account extends Model
{
    public function transactions()
    {
        return $this->hasMany(AccountTransaction::class);
    }
}
