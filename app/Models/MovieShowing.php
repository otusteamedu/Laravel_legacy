<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MovieShowing
 *
 * @property int id
 * @property int movie_rental_id
 * @property int hall_id
 * @property \Illuminate\Support\Carbon $datetime
 * @property MovieRental movieRental
 * @property Hall hall
 *
 * @package App\Models
 */
class MovieShowing extends Model
{
    //
    public $timestamps = false;

    protected $casts = [
        'datetime' => 'datetime'
    ];
    public function hall() : BelongsTo {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
    public function movieRental() : BelongsTo {
        return $this->belongsTo(MovieRental::class, 'movie_rental_id');
    }
}
