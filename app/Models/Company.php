<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property int $inn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Price[] $contracts
 * @property-read int|null $contracts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereInn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read int|null $rooms_count
 */
class Company extends ModelBase
{
    protected $fillable = ['name', 'inn'];


    public function activeRooms()
    {
        return $this->rooms()->where('stoped_at', '=' , null);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, Contract::class)->withTimestamps();//->withPivot('stoped_at');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }


//    public function activeContracts()
//    {
//        return $this->contracts()->where('deleted_at', '=', null);
//    }

//    public function contracts()
//    {
//        return $this->hasMany(Contract::class);
//    }

//    public function documents()
//    {
//        return $this->belongsToMany(Document::class)->using(Contract::class);
//    }
}
