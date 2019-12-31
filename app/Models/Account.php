<?php

/**
 * Акаунт, привязанный к пользователю.
 * @property float DISCOUNT_COEFFICIENT_MIN коэффициент скидки - его минимальное значение
 * @property float DISCOUNT_COEFFICIENT_MAX коэффициент скидки - его максимальное значение
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const DISCOUNT_COEFFICIENT_MIN=0.3;
    const DISCOUNT_COEFFICIENT_MAX=0.5;
}
