<?php

namespace App\Model\User;

use App\Model\Article\Article;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Model\User
 *
 * Пользователь
 *
 * @property int $id индетификатор
 * @property string $name имя
 * @property string $email почта
 * @property Carbon $email_verified_at дата подтверждения почты
 * @property string $password хеш пароля
 * @property string $remember_token токен
 * @property Carbon $created_at время создания
 * @property Carbon $updated_at время обновления
 * @property Carbon $deleted_at время удаления
 * @property Role[]|Collection $roles роли
 * @property UserStatistic|null $statistic статистика
 * @property Article[]|Collection $articles статьи
 */
class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

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
     * Роли
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Статистика
     * @return HasOne
     */
    public function statistic()
    {
        return $this->hasOne(UserStatistic::class);
    }

    /**
     * Статьи
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
