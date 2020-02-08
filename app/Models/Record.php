<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Record
 *
 * @property int $id
 * @property int $user_id
 * @property string $date_start
 * @property string $date_finish
 * @property int|null $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereDateFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereUserId($value)
 * @mixin \Eloquent
 * @property int $client_id
 * @property int $master_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Record onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereMasterId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Record withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Record withoutTrashed()
 */
class Record extends BaseModel
{
    use SoftDeletes;

    protected string $dateFormat = 'Y-m-d H:i:sO';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_start',
        'date_finish',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
