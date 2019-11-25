<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Place
 *
 * @property int id
 * @property int hall_id
 * @property int tariff_id
 * @property int row_number
 * @property int place_number
 * @property Tariff tariff
 * @property Hall hall
 *
 * @package App\Models
 */
class Place extends Model
{
    protected $fillable = [
        'row_number', 'place_number'
    ];

    protected $attributes = [
        'row_number' => 0,
        'place_number' => 0
    ];

    public $timestamps = false;

    public function hall() : BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function tariff() : BelongsTo
    {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }
}
