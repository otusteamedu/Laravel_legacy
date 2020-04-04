<?php

namespace App\Models;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $path
 * @property string $mime_type
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $width
 * @property int $height
 * @property string $file_type
 * @property int $usage
 * @property int|null $source_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUsage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereWidth($value)
 */
class File extends BaseModel
{
    const USAGE = 0;
    const USAGE_PLANNER_POST = 1;
    const USAGE_BLOG_AUTHOR_AVATAR = 2;
    const USAGE_BLOG_CATEGORY_PREVIEW_PICTURE = 3;
    const USAGE_BLOG_CATEGORY_DETAIL_PICTURE = 4;
    const USAGE_BLOG_POST_PREVIEW_IMAGE = 5;
    const USAGE_BLOG_POST_DETAIL_IMAGE = 6;

    const FILE_TYPE = 0;
    const FILE_TYPE_IMAGE = 1;
    const FILE_TYPE_VIDEO = 2;

    const STORAGE_PATH = "app/public/upload";

    protected $fillable = [
        'path',
        'mime_type',
        'size',
        'source',
        'width',
        'height',
        'file_type',
        'usage'
    ];

    public function source() {
        $this->hasOne(File::class);
    }

    public function relativePath() {
        return join(DIRECTORY_SEPARATOR, Array("", self::STORAGE_PATH,  $this->path));
    }

    public function fullPath() {
        return storage_path($this->relativePath());
    }
}
