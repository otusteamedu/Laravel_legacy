<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Услуги.
 *
 * Class Service
 *
 * @property int     $id
 * @property int     $account_id
 * @property string  $title
 * @property bool    $is_counter
 * @property Account $account
 */
class Service extends Model
{
    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
