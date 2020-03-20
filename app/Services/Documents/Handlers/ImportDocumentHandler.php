<?php
/**
 * Description of ImportDocumentHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Documents\Handlers;


use App\Services\Documents\Repositories\DocumentImportProgressRepository;
use Illuminate\Http\File;

class ImportDocumentHandler
{

    public function __construct(
        DocumentImportProgressRepository $documentImportProgressRepository
    )
    {
        $this->documentImportProgressRepository = $documentImportProgressRepository;
    }

    public function handle(File $file, string $id)
    {

        $total = getTotal($this);
        $rows = getRowsData($file);
        $i = 0;
        foreach ($rows as $row) {
            if ($i % 100 === 0) {
                $this->documentImportProgressRepository->set(
                    $id,
                    $this->resolveProgress($total, $i)
                );
            }
            $i++;
        }
    }

    private function resolveProgress(int $total, int $current): int
    {
        return round($current / $total) * 100;
    }

}
