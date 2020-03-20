<?php
/**
 * Description of DocumentImportJob.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Documents\Jobs;


use App\Services\Documents\Handlers\ImportDocumentHandler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;

class DocumentImportJob implements ShouldQueue
{
    use Dispatchable;

    private $file;

    public function __construct(
        File $file
    )
    {
        $this->file = $file;
    }

    public function handle(ImportDocumentHandler $importDocumentHandler)
    {
        $importDocumentHandler->handle($file);
    }


}
