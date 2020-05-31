<?php


namespace App\Services\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

/**
 * Обработчик файлов
 *
 * Class FileHandler
 * @package App\Services\File
 */
class FileHandler
{

    private $fileDataResolver;

    public function __construct(
        FileDataResolver $fileDataResolver
    )
    {
        $this->fileDataResolver = $fileDataResolver;
    }

    public function createFileFromRequest(\Illuminate\Http\UploadedFile $uploadedFile, $usage) {

        $fileData = $this->fileDataResolver->fromRequest($uploadedFile, $usage);
        $fileSaver = new FileSaver($fileData, $uploadedFile);
        return $fileSaver->save();
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deleteFileById(int $id)
    {
        $file = File::find($id);

        Storage::disk('upload')->deleteDirectory($file->subdir);

        $file->delete();
    }
}
