<?php


namespace App\Services\ImageResize\Handlers;

use File;

class GetPathExtensionHandler
{
    private $uploadPath;
    private $noImagePath;
    private $noImageExtension;

    /**
     * GetPathExtensionHandler constructor.
     */
    public function __construct()
    {
        $this->uploadPath = config('uploads.image_upload_path');
        $this->noImagePath = config('uploads.image_no_image_path');
        $this->noImageExtension = config('uploads.image_no_image_path');
    }

    /**
     * @param string $path
     * @return array
     */
    public function handle(string $path): array {
        $nameArray = explode('.', $path);
        $ext = array_pop($nameArray);
        $file = implode('.', $nameArray);
        $filePath = $this->uploadPath . implode('/', [$path[0], $path[0] . $path[1] . $path[2], $file . '.' . $ext]);

        if (!File::isFile($filePath)) {
            $filePath = $this->noImagePath;
            $ext = $this->noImageExtension;
        }
        return [$filePath, $ext];
    }
}
