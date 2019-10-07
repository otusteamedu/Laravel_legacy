<?php
/**
 * Description of FilesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Files;


use Illuminate\Http\UploadedFile;

class FilesService
{

    public function store(UploadedFile $uploadedFile)
    {
        return $uploadedFile->store('users/photo', 'public');
    }

}