<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property integer id
 * @property string name
 * @property string email
 * @property \DateTime email_verified_at
 * @property string password
 * @property integer level
 * @property string remember_token
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class User extends Authenticatable
{
    use Notifiable;


    const LEVEL_USER = 1;
    const LEVEL_MANAGER = 2;
    const LEVEL_ADMIN = 3;
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pickItems()
    {
        return $this->belongsToMany(Item::class)
            ->withPivot(['comment'])
            ->using(ItemUser::class);
    }
}
