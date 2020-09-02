<?php

namespace App\Models;
use App\Models\Film;
/**
 * App\Models\FrameForMovies
 *
 *
*/
class FrameForMovies extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image'
    ];


    public function films()
    {
        //один ко многим
        return $this->hasMany(Film::class);
    }

}
