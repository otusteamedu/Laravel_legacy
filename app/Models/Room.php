<?php

namespace App\Models;



/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $number
 * @property float $square
 * @property int|null $floor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Room whereSquare($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 */
class Room extends ModelBase
{
    public $timestamps = false;
    protected $fillable = ['number', 'square', 'floor'];


    public function isFree()
    {
        return $this->companies()->where('stoped_at', null)->count() == 0;
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, Contract::class)->withTimestamps();
    }

}
