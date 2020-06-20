<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleComment
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $text Текст
 * @property int $user_id Автор
 * @property int $article_id Идентификатор статьи
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleComment whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\User $user
 */
class ArticleComment extends Model
{
    public function article() {
        return $this->belongsTo(Article::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
