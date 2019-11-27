<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 *
 * @property int id
 * @property string file_name
 * @property string subdir
 * @property string original_name
 * @property string content_type
 * @property int width
 * @property int height
 * @property int file_size
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @package App\Models
 */
class File extends Model
{
    //
    public $timestamps = true;

    public function getPath(): string {
        return /*DIRECTORY_SEPARATOR .*/ $this->subdir . DIRECTORY_SEPARATOR . $this->file_name;
    }
}
