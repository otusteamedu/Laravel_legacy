<?php


namespace App\Base\Controller;

use App\Services\Interfaces\IUploadService;
use Illuminate\Http\Request;

/**
 * Контроллер может принимать файлы
 *
 * Trait TUploadable
 * @package App\Base\Repository
 */
trait TUploadable
{
    // возможные имена полей
    protected $uploadFields = ['photo', 'photos', 'file', 'files', 'poster', 'posters'];

    public function cmdUploadFile(IUploadService $uploadService) {
        $uploadService->uploadFiles($this->uploadFields);
    }
    public function cmdUpdateFileData(IUploadService $uploadService) {
        $uploadService->updateFiles($this->uploadFields);
    }
    public function cmdDeleteFile(IUploadService $uploadService) {
        $uploadService->removeFiles($this->uploadFields);
    }
}
