<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

/**
 * App\Models\UserGroup
 *
 * @property int $id
 * @property string $name Алиас
 * @property string $title Название
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserGroup whereTitle($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class UserGroup extends Model
{
    use Rememberable;

    //Администратор
    const ADMIN_GROUP = 'Admin';
    //Автор
    const AUTHOR_GROUP = 'Author';
    //Редактор
    const EDITOR_GROUP = 'Editor';
    //Модератор
    const MODERATOR_GROUP = 'Moderator';
    //Зарегистрированный
    const REGISTERED_GROUP = 'Registered';
    //Заблокированный
    const BLOCKED_GROUP = 'Blocked';
    //Заблокированный
    const GUEST_GROUP = 'Guest';


    protected $rememberCacheTag = 'USER_GROUPS';
    protected $rememberFor = 60 * 60;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'name',
    ];

    public function users() {
        return $this->hasMany(User::class, 'group_id');
    }
}
