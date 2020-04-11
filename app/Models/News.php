<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\News
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string $description
 * @property int|null $picture_id
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News wherePictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News withoutTrashed()
 * @mixin \Eloquent
 */
class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'picture_id',
    ];
}
