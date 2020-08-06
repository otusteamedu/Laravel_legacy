<?php

namespace App\Models;

/**
 * App\Models\ActorAndRole
 *
 * @property int $id
 * @property string $role Роль актера
 * @property int|null $film_id id фильма
 * @property int|null $actor_id id актера
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $actors
 * @property-read int|null $actors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Film[] $films
 * @property-read int|null $films_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereActorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActorAndRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActorAndRole extends Model
{
    //

    protected $table = 'actors_and_roles';


    public function films()
    {
        //один ко многим
        return $this->hasMany(Film::class);
    }

    public function actors()
    {
        //один ко многим
        return $this->hasMany(Film::class);
    }
}