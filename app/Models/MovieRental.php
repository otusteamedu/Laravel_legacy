<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MovieRental
 *
 * @property int id
 * @property int movie_id
 * @property int cinema_id
 * @property int created_user_id
 * @property \Illuminate\Support\Carbon date_start_at
 * @property \Illuminate\Support\Carbon date_end_at
 * @property Movie movie
 * @property Cinema cinema
 * @property User owner
 *
 * @package App\Models
 */
class MovieRental extends Model
{
    public $timestamps = false;

    public function movie() : BelongsTo {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function cinema() : BelongsTo {
        return $this->belongsTo(Cinema::class, 'cinema_id');
    }
    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}

