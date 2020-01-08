<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ShowingPrice
 *
 * @property int id
 * @property int movie_showing_id
 * @property int tariff_id
 * @property int value
 * @property MovieShowing movieShowing
 * @property Tariff tariff
 *
 * @package App\Models
 */
class ShowingPrice extends Model
{
    //
    public $timestamps = false;

    public function movieShowing() : BelongsTo {
        return $this->belongsTo(MovieShowing::class, 'movie_showing_id');
    }
    public function tariff() : BelongsTo {
        return $this->belongsTo(Tariff::class, 'tariff_id');
    }
}
