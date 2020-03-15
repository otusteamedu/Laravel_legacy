<?php

namespace App\Model\Article;

use App\Model\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Model\Article
 *
 * Тег
 *
 * @property int $id индетификатор
 * @property string $name название
 * @property Carbon $created_at время создания
 * @property Carbon $updated_at время обновления
 * @property Carbon $deleted_at время удаления
 * @property Article[]|Collection $articles статьи
 */
class Tag extends BaseModel
{
    use SoftDeletes;

    /**
     * Статьи
     * @return BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}

