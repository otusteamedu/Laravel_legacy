<?php

namespace App\Models;



/**
 * App\Models\Division
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Advert[] $adverts
 * @property-read int|null $adverts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Division whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Division extends Model
{

    protected $fillable = [
        'name',
    ];

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }
}
