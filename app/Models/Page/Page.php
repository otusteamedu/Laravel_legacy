<?php

namespace App\Models\Page;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package App\Models\Page
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Page extends BaseModel
{
    use SoftDeletes;

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'content', 'slug',
        'title', 'keywords', 'description',
    ];
}
