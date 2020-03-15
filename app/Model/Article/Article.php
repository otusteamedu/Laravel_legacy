<?php

namespace App\Model\Article;

use App\Model\BaseModel;
use App\Model\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * @package App\Model\Article
 *
 * Статья
 *
 * @property int $id индетификатор
 * @property int $user_id индетификатор пользователя
 * @property string $title заголовок
 * @property string $text текст
 * @property string $image_url ссылка на изображение
 * @property boolean $published флаг опубликованности
 * @property Carbon $created_at время создания
 * @property Carbon $updated_at время обновления
 * @property Carbon $deleted_at время удаления
 * @property User $user Пользователь
 * @property Tag[]|Collection $tags Теги
 */
class Article extends BaseModel
{
    use SoftDeletes;

    /** @var string[] Поля которые можно заполнять для массовой вставки */
    protected $fillable = ['title', 'text', 'image_url'];

    /**
     * Пользователь
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Теги
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

