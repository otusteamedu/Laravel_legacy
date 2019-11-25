<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Hall
 *
 * @property int id
 * @property string name
 * @property int cinema_id
 * @property string number
 * @property Place[]|\Illuminate\Database\Eloquent\Collection places
 * @property Cinema cinema
 *
 * @package App\Models
 */
class Hall extends Model
{
    protected $fillable = [
        'name', 'number'
    ];

    protected $attributes = [
        'name' => '',
        'number' => 0
    ];

    public $timestamps = false;

    public function cinema() : BelongsTo {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }

    public function places() {
        return $this
            ->hasMany(Place::class, 'hall_id', 'id');
    }
}
