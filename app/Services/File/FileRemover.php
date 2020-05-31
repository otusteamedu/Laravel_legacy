<?php


namespace App\Services\File;


use App\Models\File as FileModel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class FileRemover
{
    /**
     * @var FileModel
     */
    private $file;

    public function __construct(int $id)
    {
        $this->file = FileModel::find($id);
    }

    public function remove()
    {
        Storage::disk('upload')->delete(FilePathHelper::getSavePath($this->file->subdir, $this->file->file_name));
        return $this->file->delete();
    }
}
