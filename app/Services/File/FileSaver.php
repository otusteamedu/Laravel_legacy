<?php


namespace App\Services\File;


use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use App\Models\File as FileModel;

class FileSaver
{
    /**
     * @var FileData
     */
    private $fileData;

    /**
     * @var File
     */
    private $file;

    public function __construct(FileData $fileData, File $file)
    {
        $this->fileData = $fileData;
        $this->file = $file;
    }

    public function save()
    {
        Storage::disk('upload')->put(FilePathHelper::getSavePath($this->fileData->subDir, $this->fileData->fileName), file_get_contents($this->file->getRealPath()));
        return FileModel::create($this->fileData->toArray());
    }
}
