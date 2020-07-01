<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group withoutTrashed()
 * @mixin \Eloquent
 */
class Group extends Model
{
    /** @var int Группа администраторов */
    const STAFF_ADMIN = 1;
    /** @var int Группа менеджеров */
    const STAFF_MANAGER = 2;
    /** @var int Группа разработчиков */
    const STAFF_DEVELOPER = 3;

    /** @var int[] Группы сотрудников */
    const STAFFS = [self::STAFF_ADMIN, self::STAFF_MANAGER, self::STAFF_DEVELOPER];

    /** @var int[] Группы клиентов */
    const CLIENTS = [4];

    protected $fillable = ['name'];

    protected $rememberCacheTag = 'Group';
    protected $rememberFor = 60 * 60 * 24;

    use SoftDeletes;

    public $timestamps = false;

    /**
     * Получить пользователей группы
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
