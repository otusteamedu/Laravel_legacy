<?php

namespace App\Models\Blog;

use App\Models\BaseModel;
use App\Models\File;

/**
 * App\Models\Blog\BlogAuthor
 *
 * @property int $id
 * @property string $name
 * @property int|null $photo_id
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\BlogAuthor whereUpdatedById($value)
 * @mixin \Eloquent
 * @property-read \App\Models\File|null $photo
 */
class BlogAuthor extends BaseModel
{
    protected $fillable = [
        'name',
        'photo_id'
    ];

    public function photo(){
        return $this->belongsTo(File::class);
    }

    public function articles(){
        $this->hasMany(BlogArticle::class);
    }
}
