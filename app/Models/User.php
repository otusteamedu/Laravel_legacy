<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 *
 * @package App\Models
 * @property int id
 * @property string name
 * @property string password
 * @property int role_id
 * @property string description
 * @property string icon
 * @property string email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     *
     */
    const PRIVATE_ENTREPRENEUR_ROLE = 1;
    /**
     *
     */
    const WHOLESALER_ROLE = 2;
    /**
     *
     */
    const ADMIN_ROLE = 3;
    /**
     *
     */
    const TOP_MANAGER_ROLE = 4;
    /**
     *
     */
    const MANAGER_ROLE = 5;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return bool
     */
    public function acceptAdminPanel()
    {
        $userRoleId = $this->role_id;
        if (in_array($userRoleId, [
            self::ADMIN_ROLE,
            self::TOP_MANAGER_ROLE,
            self::MANAGER_ROLE
        ])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function acceptProfile()
    {
        $userRoleId = $this->role_id;
        if (in_array($userRoleId, [
            self::WHOLESALER_ROLE,
            self::PRIVATE_ENTREPRENEUR_ROLE,
        ])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role_id === self::ADMIN_ROLE;
    }

    /**
     * @return bool
     */
    public function isTopManager()
    {
        return $this->role_id === self::TOP_MANAGER_ROLE;
    }

    /**
     * @return bool
     */
    public function isManager()
    {
        return $this->role_id === self::MANAGER_ROLE;
    }

    /**
     * @return bool
     */
    public function isPrivateEntrepreneur()
    {
        return $this->role_id === self::PRIVATE_ENTREPRENEUR_ROLE;
    }

    /**
     * @return bool
     */
    public function isWholesaler()
    {
        return $this->role_id === self::WHOLESALER_ROLE;
    }
}
