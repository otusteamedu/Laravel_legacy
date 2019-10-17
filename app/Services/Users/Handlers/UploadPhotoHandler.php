<?php
/**
 * Description of UploadPhotoHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Users\Handlers;

use Illuminate\Support\Facades\File;

class UploadPhotoHandler
{

    const FLAG_DELETED = 'deleted';
    const DEFAULT_PATH = '';

    public function handle(File $file)
    {

    }

}