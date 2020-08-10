<?php

namespace App\Models;

/**
 * App\Models\Producer
 *
 * @property int $id
 * @property string $name Фио режиссера
 * @property string $slug Фио режиссера транслитом для чпу
 * @property string|null $description описание режиссера
 * @property string $image Путь до фото режиссера на сервере
 * @property int|null $film_id id фильма
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereFilmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Producer extends Model
{
    //
}