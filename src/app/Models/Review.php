<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $business_id
 * @property int $user_id
 * @property int|null $worker_id id пользователя, если отзыв для конкретного работника
 * @property int|null $procedure_id id процедуры, если отзыв для конкретнй процедуры
 * @property int $rating
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\Procedure|null $procedure
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $worker
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereWorkerId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'user_id',
        'worker_id',
        'procedure_id',
        'rating',
        'text',
        'created_at',
        'updated_at',
    ];

    /**
     * Business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    /**
     * Procedure
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function procedure()
    {
        return $this->hasOne(Procedure::class);
    }

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Worker
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne(User::class);
    }
}
