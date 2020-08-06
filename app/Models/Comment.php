<?php

namespace App\Models;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string|null $comment комментарий
 * @property int|null $film_id id фильма
 * @property int|null $user_id id пользователя
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $films
 * @property-read int|null $films_count
 */
class Comment extends Model
{
    //

    protected $table = 'comments';


    public function films()
    {
        //один ко многим
        return $this->hasMany(Film::class);
    }
}