<?php

namespace App\Models\Page;

use App\Models\BaseModel;

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
 */
class Page extends BaseModel
{
    /** @inheritDoc  */
    protected $table = 'pages';

    /** @inheritDoc  */
    protected $fillable = [
        'name', 'content', 'slug',
        'title', 'keywords', 'description',
    ];
}
