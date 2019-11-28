<?php


namespace App\Services\Interfaces;

use App\Services\FileService;
use App\Base\Service\IBaseService;
use Illuminate\Http\UploadedFile;

interface IUploadService extends IBaseService
{
    public function uploadFiles(array $only = []);

    public function updateFiles(array $only = []);

    public function removeFiles(array $only = []);

    public function uploadFile(string $field, UploadedFile $file, array $data);

    public function removeFile(int $item_id);

    public function updateData(int $item_id, array $data);

    public function detachFile(int $item_id): int;

    public function empty(): bool;

    public function loadData(): array;

    public function clearOldFiles();

    public function clearCurrent();

    public function getFileService(): FileService;
}
