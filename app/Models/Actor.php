<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Actor
 *
 * @property int $id
 * @property string $name Фио актера
 * @property string $slug Фио актера транслитом для чпу
 * @property string|null $description описание актера
 * @property string $image Путь до фото актера на сервере
 * @property int|null $film_id id фильма
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $films
 * @property-read int|null $films_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Actor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Actor extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'actors';


    public function films()
    {
      //один ко многим
       return $this->belongsTo(Film::class);
    }

}
