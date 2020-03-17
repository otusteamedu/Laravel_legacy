<?php

namespace App\Models;

use App\Services\UserGroup\UserGroupRepositoryInterface;
use App\Services\UserGroup\UserGroupService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int $group_id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $material
 * @property string|null $note
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $masters
 * @property-read int|null $clients_count
 * @property-read \App\Models\UserGroup $group
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMaterial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Record[] $clientRecords
 * @property-read int|null $client_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Record[] $masterRecords
 * @property-read int|null $master_records_count
 * @property-read int|null $masters_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @property string|null $phone_number
 * @property-read \App\Models\ClientInformation $clientInformation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhoneNumber($value)
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check relation master-client
     *
     * @param int $clientId
     * @return bool
     */
    public function hasClient(int $clientId): bool
    {
        return $this->clients()->wherePivot('client_id', '=', $clientId)->first() !== null;
    }

    /**
     * Check relation client-master
     *
     * @param int $masterId
     * @return bool
     */
    public function hasMaster(int $masterId): bool
    {
        return $this->clients()->wherePivot('master_id', '=', $masterId)->first() !== null;
    }

    /**
     * Return user group (UserGroup)
     *
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class);
    }

    /**
     * Return master's clients
     *
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'masters_client', 'master_id', 'client_id');
    }

    /**
     * Return client's masters
     *
     * @return BelongsToMany
     */
    public function masters(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'masters_client', 'client_id', 'master_id');
    }

    /**
     * Return master's records
     *
     * @return HasMany
     */
    public function masterRecords(): HasMany
    {
        return $this->hasMany(Record::class, 'master_id');
    }

    /**
     * Return client's records
     *
     * @return HasMany
     */
    public function clientRecords(): HasMany
    {
        return $this->hasMany(Record::class, 'client_id');
    }

    /**
     * Return client's information
     *
     * @return HasOne
     */
    public function clientInformation(): HasOne
    {
        return $this->hasOne(ClientInformation::class, 'user_id');
    }
}
