<?php


namespace App\Services;

use App\Repositories\Files\IFileRepository;
use Illuminate\Http\File;

/**
 * Управляет копированием файлов в публичные папки с синхронным добавлением в БД
 *
 * Class FileService
 * @package App\Services
 */
class FileService
{
    /**
     * Базовая папка
     *
     * @var string
     */
    private $basePath;
    /**
     *  @var IFileRepository
     */
    private $repository;
    /**
     * FileService constructor.
     * @param string $basePath
     * @param IFileRepository $repository
     */
    public function __construct(?string $basePath, IFileRepository $repository)
    {
        $this->basePath = $basePath;
        $this->repository = $repository;
    }

    private static function getFileName(File $file): string {
        $file->extension();
    }

    private static function getSubdir(string $fileName): string {

    }
}
