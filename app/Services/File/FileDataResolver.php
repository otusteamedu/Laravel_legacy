<?php


namespace App\Services\File;


use Intervention\Image\Facades\Image;

class FileDataResolver
{

    /**
     * @param \Illuminate\Http\UploadedFile $uploadedFile
     * @param $usage
     * @return FileData
     */
    public function fromRequest(\Illuminate\Http\UploadedFile $uploadedFile, $usage)
    {
        $pathHelper = new FilePathHelper($uploadedFile->getClientOriginalName());

        $path = $uploadedFile->getRealPath();
        $fileName = $uploadedFile->getClientOriginalName();
        $mimeType = $uploadedFile->getMimeType();
        $size = $uploadedFile->getSize();
        $fileType = \App\Models\File::FILE_TYPE;
        $width = 0;
        $height = 0;

        if (self::isImage($path)) {
            $image = Image::make($path);
            $fileType = \App\Models\File::FILE_TYPE_IMAGE;
            $width = $image->getWidth();
            $height = $image->getHeight();
        }

        $fileData = new FileData(
            $fileName,
            $mimeType,
            $size,
            $pathHelper->getSubDir(),
            null,
            $fileType,
            $usage,
            $width,
            $height
        );

        return $fileData;
    }

    private static function isImage($strFileName)
    {
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
        $contentType = mime_content_type($strFileName);

        return in_array($contentType, $allowedMimeTypes);
    }
}
