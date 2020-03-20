<?php
/**
 * Description of DocumentsService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Documents;


use App\Services\Documents\Handlers\StartImportHandler;
use App\Services\Documents\Repositories\DocumentImportProgressRepository;

class DocumentsService
{

    public function __construct(
        StartImportHandler $startImportHandler,
        DocumentImportProgressRepository $documentImportProgressRepository
    )
    {
        $this->startImportHandler = $documentImportProgressRepository;
        $this->documentImportProgressRepository = $documentImportProgressRepository;
    }

    public function getProgress(string $id): ?int
    {
        return $this->documentImportProgressRepository->get($id);
    }

}
