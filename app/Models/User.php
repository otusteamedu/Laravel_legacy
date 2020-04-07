<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int level
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string api_token
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'tariff_id',
        'segment_id',
        'role',
    ];
}
