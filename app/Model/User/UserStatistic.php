<?php

namespace App\Model\User;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserStatistic
 * @package App\Model\User
 *
 * Статистика пользователя
 *
 * @property int $user_id идентификатор пользователя
 * @property int $involvement вовлеченность
 * @property int $popularity популярность
 * @property User $user пользователь
 */
class UserStatistic extends BaseModel
{
    /** @var bool Не имеет полей created_at и updated_at */
    public $timestamps = false;

    /** @var string[] Поля которые можно заполнять для массовой вставки */
    protected $fillable = ['user_id', 'involvement', 'popularity'];

    /**
     * Пользователь
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
