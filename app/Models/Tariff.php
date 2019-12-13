<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tariff
 *
 * @property int id
 * @property string name
 * @property string code
 * @property float defaultKoef
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 */
class Tariff extends Model
{
    protected $fillable = [
        'code',
        'name',
        'defaultKoef',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'code' => '',
        'name' => '',
        'defaultKoef' => 1.00,
        'created_at' => '',
        'updated_at' => ''
    ];

    public $timestamps = true;
}
