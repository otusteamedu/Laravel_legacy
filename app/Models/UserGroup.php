<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class UserGroup extends Model
{
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


    public $timestamps = false;

    protected $fillable = [
        'title',
        'name',
    ];

    public function users() {
        return $this->hasMany(User::class, 'group_id');
    }
}
