<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;


/**
 * App\Models\ArticleState
 *
 * @property int $id
 * @property string $name Наименование
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleState query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleState whereName($value)
 * @mixin \Eloquent
 */
class ArticleState extends Model
{
    use Rememberable;

    const STATE_DRAFT = 1;
    const STATE_WAITING_PUBLICATION = 2;
    const STATE_PUBLISHED = 3;

    protected $rememberCacheTag = 'ARTICLE_STATE';
    protected $rememberFor = 60 * 60;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
