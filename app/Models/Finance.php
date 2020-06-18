<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Finance
 *
 * @property int $id
 * @property int $user_id
 * @property int $operation
 * @property float $sum
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Finance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Finance whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Finance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Finance withoutTrashed()
 * @mixin \Eloquent
 */
class Finance extends Model
{
    use SoftDeletes;

    /** @var int Операция пополнения */
    const OPERATION_PLUS = 1;
    /** @var int Операция списания */
    const OPERATION_MINUS = 0;

    /**
     * Получить пользователя финансовой операции
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
