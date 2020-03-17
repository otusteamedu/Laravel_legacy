<?php

namespace App\Model\User;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 * @package App\Model\User
 *
 * Роль
 *
 * @property int $id Идентификатор
 * @property string $name Название роли
 * @property string $code Код роли
 * @property User[]|Collection $users Код роли
 */
class Role extends BaseModel
{
    /** @var bool Не имеет полей created_at и updated_at */
    public $timestamps = false;

    /** @var string[] Поля которые можно заполнять для массовой вставки */
    protected $fillable = ['name', 'code'];

    /**
     * Пользователи
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
