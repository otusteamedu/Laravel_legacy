<?php

namespace App\Models;



/**
 * App\Models\Town
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Advert[] $adverts
 * @property-read int|null $adverts_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Town whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Town extends Model
{

    protected $fillable = [
        'name',
    ];

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }
}
