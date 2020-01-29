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

//    /**
//     * The attributes that should be cast to native types.
//     *
//     * @var array
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socials()
    {
        return $this->hasMany(UserSocial::class, 'user_id', 'id');
    }

    /**
     * @param $service
     * @return bool
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
        return $this->belongsTo('App\Models\Address');
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->publish;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return (bool) $this->verified;
    }

    /**
     * @param $query
     * @param $token
     * @return mixed
     */
    public function scopeGetUserVerify($query, $token)
    {
        return $query->whereHas('verifyUser', function (Builder $query) use ($token) {
            $query->where('token', 'like', $token);
        })->firstOrFail();
    }

    public function scopeGetUserBySocialId($query, int $id)
    {
        return $query->whereHas('user_social', function (Builder $query) use ($id) {
            $query->where('social_id', 'like', $id);
        })->get();
    }
}
