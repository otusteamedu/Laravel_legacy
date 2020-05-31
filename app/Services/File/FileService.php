<?php


namespace App\Services\File;


use phpDocumentor\Reflection\File;

class FileService
{

    /**
     * @var FileResolver
     */
    private $fileResolver;

    /**
     * @var FileHandler
     */
    private $fileHandler;

    public function __construct(
        FileResolver $fileResolver,
        FileHandler $fileHandler
    )
    {
        $this->fileResolver = $fileResolver;
        $this->fileHandler = $fileHandler;
    }

    public function createFileFromRequest(\Illuminate\Http\UploadedFile $uploadedDile, $usage)
    {
        return $this->fileHandler->createFileFromRequest($uploadedDile, $usage);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteFileById(int $id)
    {
        $this->fileHandler->deleteFileById($id);
    }
}
