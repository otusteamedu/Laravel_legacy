<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $expiration_date
 * @property int $project_id
 * @property int $city_id
 * @property float $lat
 * @property float $lon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Offer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Offer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Offer withoutTrashed()
 * @mixin \Eloquent
 */
class Offer extends BaseModel
{
    use SoftDeletes;

    public $entityName = 'offer';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected $fillable = [
        'name',
        'description',
        'promo_code',
        'expiration_date',
        'project_id',
        'category_id',
        'city_id',
        'lat',
        'lon',
        'teaser_image',
    ];

}
