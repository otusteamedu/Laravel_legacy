<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_solved
 * @property string $description
 * @property int $country_id
 * @property int $author_id
 * @property int $type_id
 * @property string $region
 * @property string $locality
 * @property float $lat
 * @property float $long
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereIsSolved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 */
class Event extends Model
{
    use SoftDeletes;

    public function participants() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
