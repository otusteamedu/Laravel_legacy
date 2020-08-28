<?php

namespace App\Models;

/**
 * App\Models\Genre
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name название жанра
 * @property string|null $slug название фильма транслитом для ЧПУ
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Genre whereUpdatedAt($value)
 */
class Genre extends Model
{
    //

    protected $table = 'genres';

    protected $fillable = [
        'name',
        'slug'
    ];



    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}