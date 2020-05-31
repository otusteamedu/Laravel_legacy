<?php

namespace App\Models\Blog;

use App\Models\BaseModel;
use App\Models\File;

/**
 * App\Models\Blog\BlogArticle
 *
 * @property int $id
 * @property string $text
 * @property string $name
 * @property int|null $blog_author_id
 * @property int|null $preview_picture_id
 * @property int|null $detail_picture_id
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereBlogAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereDetailPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle wherePreviewPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogArticle whereUpdatedById($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Blog\BlogAuthor|null $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\BlogCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\File|null $detailPucture
 */
class BlogArticle extends BaseModel
{
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
        return $this->hasOne(File::class);
    }

    public function author(){
        return $this->belongsTo(BlogAuthor::class, 'blog_author_id');
    }

    public function categories(){
        return $this->belongsToMany(BlogCategory::class);
    }
}
