<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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

    public $entityName = 'user';

    const LEVEL_USER = 'user';
    const LEVEL_MARKETING = 'marketing';
    const LEVEL_ADMIN = 'admin';

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

    public function isAdmin(){
        return Auth::user()->role == self::LEVEL_ADMIN;
    }

    public function canDo($action, $entity){
        return config('user-actions.'.$this->role.'.'.$action.'-'.$entity, config('user-actions.default-value-if-null'));
    }
}
