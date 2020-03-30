<?php

namespace App\Models\Blog;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Category
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int|null $preview_picture_id
 * @property int|null $detail_picture_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereDetailPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category wherePreviewPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends BaseModel
{
    protected $table = "blog_categories";

    protected $fillable = [
        'name',
        'preview_picture_id',
        'detail_picture_id',
        'parent_id'
    ];

    public function previewPicture() {
        return  $this->hasOne(File::class);
    }

    public function detailPicture() {
        return  $this->hasOne(File::class);
    }

    public function parent() {
        return  $this->hasOne(Category::class);
    }

    public function articles() {
        return $this->belongsToMany(Article::class, 'blog_article_blog_category', 'blog_category_id', 'blog_article_id');
    }
}
