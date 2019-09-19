<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Услуги
 *
 * Class Service
 * @package App\Models
 * @property int $id
 * @property int $account_id
 * @property string $title
 * @property boolean $is_counter
 * @property Account $account
 */
class Service extends Model
{
    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
