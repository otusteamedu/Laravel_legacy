<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Ticket
 *
 * @property int id
 * @property int movie_rental_id
 * @property int place_id
 * @property int created_user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property int released_user_id
 * @property \Illuminate\Support\Carbon $released_at
 * @property MovieRental movieRental
 * @property Place place
 *
 * @package App\Models
 */
class Ticket extends Model
{
    public $timestamps = false;

    public function movieRental() : BelongsTo {
        return $this->belongsTo(MovieRental::class, 'movie_rental_id');
    }
    public function place() : BelongsTo {
        return $this->belongsTo(Place::class, 'place_id');
    }
    public function creator() : BelongsTo {
        return $this->belongsTo(User::class, 'created_user_id');
    }
    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'released_user_id');
    }
}
