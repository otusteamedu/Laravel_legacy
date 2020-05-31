<?php


namespace App\Services\File;


use Illuminate\Support\Facades\Storage;

class FilePathHelper
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $subDir;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->subDir = $this->generateSubDir();
    }

    /**
     * Генерирует название папки для сохранения
     * @return false|string
     */
    private function generateSubDir() {
        $i = 0;

        $subDir = substr(md5(uniqid("", true)), 0, 3);
        $uploadDirFullPath = join(
            DIRECTORY_SEPARATOR,
            Array(
                Storage::disk('local')->path(config('filesystems.storage_path')),
                $subDir
            )
        );

        while(true) {
            $i++;

            if(!is_dir($uploadDirFullPath) && $i <= 10) {
                break;
            }
        }

        return $subDir;
    }

    public function getSubDir() {
        return $this->subDir;
    }

    public function getFileName() {
        return $this->fileName;
    }

    /**
     * Собирает путь до файла
     *
     * @param $subDir
     * @param $fileName
     * @return string
     */
    public static function getUrl($subDir, $fileName)
    {
        return Storage::disk('upload')->url(join(DIRECTORY_SEPARATOR, Array(
            config('filesystems.storage_path'),
            $subDir,
            $fileName
        )));
    }

    /**
     * Собирает путь до файла
     *
     * @param $subDir
     * @param $fileName
     * @return string
     */
    public static function getSavePath($subDir, $fileName)
    {
        return join(DIRECTORY_SEPARATOR, Array(
            $subDir,
            $fileName
        ));
    }
}

