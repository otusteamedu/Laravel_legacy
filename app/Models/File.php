<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * @property int id
 * @property string fileName
 * @property string subdir
 * @property string originalName
 * @property string contentType
 * @property int width
 * @property int height
 * @property int fileSize
 * @package App\Models
 */
class File extends Model
{
    //
    public $timestamps = true;
}
