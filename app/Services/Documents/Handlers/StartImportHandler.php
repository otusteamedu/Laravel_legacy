<?php
/**
 * Description of StartImportHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Documents\Handlers;


use App\Services\Documents\Jobs\DocumentImportJob;
use Illuminate\Http\File;

class StartImportHandler
{

    public function handle(File $file)
    {
        // validate

        $id = md5(microtime(true));
        DocumentImportJob::dispatch($file, $id);

        return $id;
    }

}
