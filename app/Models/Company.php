<?php

namespace App\Models;


/**
 * App\Models\Company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company query()
 * @mixin \Eloquent
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Company whereUrl($value)
 */
class Company extends Model
{
    const STATUS_ACTIVE = 10;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function moderatorUsers()
    {
        return $this->users()->where('Level', CompanyUser::LEVEL_MODERATOR);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(CompanyUser::class);
    }
}
