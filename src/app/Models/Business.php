<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Business
 *
 * @property int $id
 * @property string $name
 * @property int|null $user_id
 * @property int|null $type_id
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BusinessAddress[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BusinessContact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\BusinessType|null $type
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Business whereUserId($value)
 * @mixin \Eloquent
 */
class Business extends Model
{
    const STATUS_REGISTERED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_BLOCKED = 2;

    public $fillable = [
        'id',
        'name',
        'user_id',
        'type_id',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Address
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(BusinessAddress::class);
    }

    /**
     * Contacts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(BusinessContact::class);
    }

    /**
     * Business Type
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type()
    {
        return $this->hasOne(BusinessType::class, 'id', 'type_id');
    }

    /**
     * User
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
