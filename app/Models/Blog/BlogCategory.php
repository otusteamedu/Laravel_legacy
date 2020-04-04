<?php

namespace App\Models\Blog;

use App\Models\File;
use App\Models\BaseModel;


/**
 * App\Models\Blog\BlogCategory
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int|null $preview_picture_id
 * @property int|null $detail_picture_id
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\BlogArticle[] $articles
 * @property-read int|null $articles_count
 * @property-read \App\Models\File $detailPicture
 * @property-read \App\Models\Blog\BlogCategory $parent
 * @property-read \App\Models\File $previewPicture
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereDetailPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory wherePreviewPictureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogCategory whereUpdatedById($value)
 * @mixin \Eloquent
 */
class BlogCategory extends BaseModel
{
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
        return  $this->hasOne(BlogCategory::class);
    }

    public function articles() {
        return $this->belongsToMany(BlogArticle::class);
    }
}
