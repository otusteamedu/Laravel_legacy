<?php

namespace App\Models\Blog;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Article
 *
 * @property int $id
 * @property string $text
 * @property int|null $blog_author_id
 * @property int|null $preview_picture_id
 * @property int|null $detail_picture_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereBlogAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereDetailPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article wherePreviewPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Article whereName($value)
 */
class Article extends Model
{
    protected $table = "blog_articles";

    protected $fillable = [
        'name',
        'text',
        'blog_author_id',
        'preview_picture_id',
        'detail_picture_id'
    ];

    public function previewPucture(){
        $this->hasOne(File::class);
    }

    public function detailPucture(){
        $this->hasOne(File::class);
    }

    public function author(){
        $this->hasOne(Author::class);
    }

    public function categories(){
        $this->belongsToMany(Category::class, 'blog_article_blog_category', 'blog_article_id', 'blog_category_id');
    }
}
