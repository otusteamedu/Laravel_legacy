<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Record
 *
 * @property int $id
 * @property int $business_id
 * @property int|null $procedure_id
 * @property int|null $client_id
 * @property string $date_start
 * @property string $date_end
 * @property int $user_create
 * @property int $user_update
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Business|null $business
 * @property-read \App\Models\User|null $client
 * @property-read \App\Models\Procedure|null $procedure
 * @property-read \App\Models\User|null $userCreate
 * @property-read \App\Models\User|null $userUpdate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereUserCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Record whereUserUpdate($value)
 * @mixin \Eloquent
 */
class Record extends Model
{
    public $fillable = [
        'id',
        'business_id',
        'procedure_id',
        'client_id',
        'date_start',
        'date_end',
        'user_create',
        'user_update',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userCreate()
    {
        return $this->hasOne(User::class);
    }

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userUpdate()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Business
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    /**
     * Procedure
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function procedure()
    {
        return $this->hasOne(Procedure::class, 'id', 'procedure_id');
    }

    /**
     * Client
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
