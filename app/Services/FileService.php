<?php


namespace App\Services;

use App\Repositories\Files\IFileRepository;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\File;
use App\Models\File as FileModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Управляет копированием файлов в публичные папки с синхронным добавлением в БД
 * Работаем только с хранилищем public
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
     *  @var Filesystem
     */
    private $storage;
    /**
     * FileService constructor.
     * @param string $basePath
     * @param IFileRepository $repository
     */
    public function __construct(string $basePath, IFileRepository $repository)
    {
        $this->basePath = $basePath;
        $this->repository = $repository;
        // basePath должен заканчиваться на DIRECTORY_SEPARATOR
        if(substr($this->basePath, -1, 1) !== DIRECTORY_SEPARATOR)
            $this->basePath .= DIRECTORY_SEPARATOR;

        $this->storage = Storage::disk('public');
    }
    /**
     * @return Filesystem
     */
    public function getStorage(): Filesystem {
        return $this->storage;
    }
    /**
     * Директория для хранения файла
     *
     * @param UploadedFile $file
     * @return string
     */
    private function getTargetPath(UploadedFile $file) {
        return $this->basePath . self::getSubdir($file);
    }
    /**
     * Защищенное имя файла
     *
     * @param UploadedFile $file
     * @return string
     */
    private static function getTargetName(UploadedFile $file): string {
        // такая комбинация не повторится
        $md5Val = md5($file->getRealPath().$file->getSize().$file->getCTime());
        return sprintf("%s.%s", $md5Val, $file->getClientOriginalExtension());
    }
    /**
     *
     * @param UploadedFile $file
     * @return string
     */
    private static function getSubdir(UploadedFile $file): string {
        $targetName = self::getTargetName($file);
        $dir1 = substr($targetName, 0, 3);
        $dir2 = substr($targetName, 3, 3);

        return sprintf("%s/%s", $dir1, $dir2);
    }
    /**
     *   Возможные расшерения картинок
     *
     * @return array
     */
    public static function GetImageExtensions()
    {
        return ["jpg", "bmp", "jpeg", "jpe", "gif", "png"];
    }
    /**
     * Является ли файл картинкой
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function isImage(UploadedFile $file) {
        $mimeParts = explode("/", $file->getMimeType());
        if(count($mimeParts) < 2)
            return false;

        return ($mimeParts[0] == 'image') && in_array($mimeParts[1], self::GetImageExtensions());
    }
    /**
     * @param UploadedFile $file
     * @return FileModel
     */
    private function createModel(UploadedFile $file): FileModel {
        $model = new FileModel();

        $model->file_name = self::getTargetName($file);
        $model->subdir = self::getSubdir($file);
        $model->original_name = $file->getClientOriginalName();
        $model->content_type = $file->getMimeType();
        $model->file_size = $file->getSize();

        if(self::isImage($file)) {
            $info = getimagesize($file->getRealPath());
            $model->width = (int) $info[0];
            $model->height = (int) $info[1];
        }

        return $model;
    }
    /**
     * @param UploadedFile $file
     * @return bool
     * @throws FileNotFoundException
     */
    private function move(UploadedFile $file): bool {
        $targetPath = $this->getTargetPath($file);

        if(!$this->getStorage()->makeDirectory($targetPath))
            return false;

        return $this->getStorage()->put($targetPath . "/" . self::getTargetName($file), $file->get());
    }
    /**
     * Переносит файл в хранилище и сохраняет сущность в таблице БД
     *
     * @param UploadedFile $file
     * @return FileModel|null
     * @throws FileNotFoundException
     */
    public function saveFile(UploadedFile $file): ?FileModel {
        if(!($file->isValid() && $this->move($file)))
            return null;

        $photo = $this->createModel($file);
        $photo->save();

        return $photo;
    }
    /**
     * Удаляет файл из хранилища и сущность из БД
     *
     * @param FileModel $model
     * @return bool
     * @throws Exception
     */
    public function removeFile(FileModel $model): bool {
        $targetPath = $this->basePath . $model->getPath();

        if($this->getStorage()->exists($targetPath))
            $this->getStorage()->delete($targetPath);

        $model->delete();
        return true;
    }
    /**
     * Колхоз... считаем, что файл сохранен в локальном хранилище
     * тут, видимо надо проводить процедуру копирования файла в темповую папку,
     * чтобы потом из нее можно было получить объект для библиотеки GD
     *
     * @param FileModel $model
     * @return File
     */
    public function getLocalFile(FileModel $model): ?File {
        $targetPath = $this->basePath . $model->getPath();
        if(!$this->getStorage()->exists($targetPath))
            return null;

        return new File(
            config('filesystems.disks.public.root').$targetPath
        );
    }
    public function getLocalFileArray(array $fileArray): ?File {
        $targetPath = $this->basePath . $fileArray['subdir'] . DIRECTORY_SEPARATOR . $fileArray['file_name'];
        if(!$this->getStorage()->exists($targetPath))
            return null;

        return new File(
            config('filesystems.disks.public.root').$targetPath
        );
    }
    /**
     * @param FileModel $model
     * @return string
     */
    public function getAssetUrl(FileModel $model): string {
        return asset('/storage' . $this->basePath.$model->getPath());
    }
    public function getAssetFile(File $file): string {
        $relPath = substr($file->getPathname(), strlen(config('filesystems.disks.public.root')));
        return asset('/storage' . $relPath);
    }
    /**
     * @param FileModel $model
     * @param UploadedFile $file
     * @return FileModel|null
     */
    public function replaceFile(UploadedFile $file, FileModel $model): ?FileModel {
        return null;
    }
}
