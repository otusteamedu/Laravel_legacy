<?php

namespace App\Models\Blog;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog\Author
 *
 * @property int $id
 * @property string $name
 * @property int|null $photo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Blog\Author whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    protected $table = 'blog_authors';

    protected $fillable = [
        'name',
        'photo_id'
    ];

    public function previewPucture(){
        $this->hasOne(File::class);
    }

    public function articles(){
        $this->hasMany(Article::class);
    }
}
