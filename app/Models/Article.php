<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $published_at Дата публикации
 * @property int $state Состояние
 * @property int $category_id Идентификатор категории
 * @property int|null $user_id Идентификатор пользователя добавившего статью
 * @property int|null $hits Количество просмотров
 * @property string $title Название
 * @property string|null $image_intro Изображение
 * @property string|null $intro_text Вступительный текст
 * @property string|null $full_text Полный текст
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereFullText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereImageIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIntroText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUserId($value)
 * @mixin \Eloquent
 */
class Article extends Model
{

    protected $fillable = [
        'title',
        'intro_text',
        'full_text',
        'state',
        'category_id',
        'user_id'
    ];

    public function comments() {
        return $this->hasMany(ArticleComment::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
