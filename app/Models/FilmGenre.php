<?php

namespace App\Models;

class FilmGenre extends Model
{
    //

    protected $table = 'film_genre';

    protected $fillable = [
        'id',
        'film_id',
        'genre_id'
    ];

    public function films()
    {
        //один ко многим
        return $this->hasMany(Film::class);
    }

    public function genres()
    {
        //один ко многим
        return $this->hasMany(Genre::class);
    }
}
