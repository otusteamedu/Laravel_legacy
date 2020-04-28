<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reason
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Reason extends Model
{
    protected $guarded = [];


    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
