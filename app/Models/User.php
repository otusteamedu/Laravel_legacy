<?php

namespace App\Models;

use App\Notifications\MailEmailConfirmation;
use App\Notifications\MailNewEmailConfirmation;
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

    public const DEFAULT_ROLE  = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmed', 'publish'
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

    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

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

    public function sendEmailConfirmationNotification()
    {
        $this->notify(new MailEmailConfirmation());
    }

    public function sendNewEmailConfirmationNotification()
    {
        $this->notify(new MailNewEmailConfirmation());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emailConfirmation()
    {
        return $this->hasOne(EmailConfirmation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart() {
        return $this->hasOne('App\Models\Cart');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany('App\Models\Image', 'likes', 'user_id', 'image_id');
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
    public function isConfirmed(): bool
    {
        return (bool) $this->confirmed;
    }

    /**
     * @param $query
     * @param string $token
     * @return mixed
     */
    public function scopeGetEmailConfirmation($query, string $token)
    {
        return $query->whereHas('emailConfirmation', function (Builder $query) use ($token) {
            $query->where('token', 'like', $token);
        });
    }

    /**
     * @param $query
     * @param string $id
     * @return mixed
     */
    public function scopeGetUserBySocialId($query, string $id)
    {
        return $query->whereHas('socials', function (Builder $query) use ($id) {
            $query->where('social_id', 'like', $id);
        })->get();
    }
}
