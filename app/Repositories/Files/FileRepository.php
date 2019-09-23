<?php


namespace App\Repositories\Files;


use App\Models\File;

class FileRepository implements IFileRepository
{
    public function find(int $id)
    {
        return File::find($id);
    }
    public function createFromArray(array $data): File
    {
        $file = new File();
        $file->create($data);
        return $file;
    }
    public function updateFromArray(File $file, array $data)
    {
        $file->update($data);
        return $file;
    }
    public function remove(File $file) {
        $file->delete();
    }
}
