<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Movie
 *
 * @property int id
 * @property string name
 * @property int producer_id
 * @property \Illuminate\Support\Carbon premiereDate
 * @property string description
 * @property string slogan
 * @property int duration
 * @property string age_limit
 * @property int poster_id
 * @property string trailer_link
 * @property int created_user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property Person producer
 * @property Genre[]|\Illuminate\Database\Eloquent\Collection genres
 * @property Country[]|\Illuminate\Database\Eloquent\Collection countries
 * @property Person[]|\Illuminate\Database\Eloquent\Collection actors
 * @property File poster
 * @property User owner
 *
 * @package App\Models
 */
class Movie extends Model
{
    //
    protected $fillable = [
        'name',
        'premiereDate',
        'description',
        'slogan',
        'duration',
        'age_limit',
        'trailer_link',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'name' => '',
        'premiereDate' => '',
        'description' => '',
        'slogan' => '',
        'duration' => '',
        'age_limit' => '',
        'trailer_link' => '',
        'created_at' => '',
        'updated_at' => ''
    ];

    public $timestamps = true;

    public function producer() : BelongsTo {
        return $this->belongsTo(Person::class, 'producer_id');
    }

    public function genres() {
        return $this
            ->belongsToMany('App\Models\Genre', 'movie_genre')
            ->using('App\Models\MovieGenre');
    }

    public function countries() {
        return $this
            ->belongsToMany('App\Models\Country', 'movie_country')
            ->using('App\Models\MovieCountry');
    }

    public function actors() {
        return $this
            ->belongsToMany('App\Models\Person', 'movie_actor', 'movie_id', 'actor_id')
            ->using('App\Models\MovieActor');
    }

    /**
     * @return BelongsTo
     */
    public function poster() : BelongsTo
    {
        return $this->belongsTo(File::class, 'poster_id');
    }

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }
}
