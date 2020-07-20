<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Procedure
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $worker_id id пользователя, к которому привязана процедура
 * @property int $duration Продолжительность в мин.
 * @property float $price
 * @property int $people_count Кол-во человек для одновременной записи
 *
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\User|null $worker
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure wherePeopleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Procedure whereWorkerId($value)
 * @mixin \Eloquent
 */
class Procedure extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'worker_id',
        'duration',
        'price',
        'people_count',
    ];

    public $timestamps = false;

    /**
     * Worker
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function worker()
    {
        return $this->hasOne(User::class, 'id', 'worker_id');
    }

    /**
     * Business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }
}
