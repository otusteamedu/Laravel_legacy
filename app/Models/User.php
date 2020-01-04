<?php

namespace App\Models;

use App\Notifications\MailEmailVerification;
use App\Notifications\MailResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'publish'
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
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    protected $with = ['roles:id,name,display_name'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function socials()
    {
        return $this->hasMany(UserSocial::class, 'user_id', 'id');
    }

    public function hasSocialLinked($service)
    {
        return (bool) $this->socials->where('service', $service)->count();
    }

    /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new MailEmailVerification);
    }

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address');
    }

    public function scopeGetUserVerify($query, $token)
    {
        return $query->whereHas('verifyUser', function (Builder $query) use ($token) {
            $query->where('token', 'like', $token);
        })->firstOrFail();
    }
}
