<?php

namespace App\Helpers\File;

use Intervention\Image\Facades\Image;

class Helper
{
    public static function getFileArray($strFileName, $usage = \App\Models\File::USAGE)
    {
        if (!file_exists($strFileName)) {
            throw new \Error("File '" . $strFileName . "' is not exists");
        }

        $file = new \SplFileInfo($strFileName);

        $arFile = [
            "path" => $file->getFilename(),
            "mime_type" => mime_content_type($strFileName),
            "size" => $file->getSize()
        ];

        if (self::isImage($strFileName)) {
            $image = Image::make($strFileName);
            $arFile["usage"] = $usage;
            $arFile["file_type"] = \App\Models\File::FILE_TYPE_IMAGE;
            $arFile["width"] = $image->getWidth();
            $arFile["height"] = $image->getHeight();
        }

        return $arFile;
    }

    public static function isImage($strFileName)
    {
        return file_exists($strFileName) && exif_imagetype($strFileName) !== false;
    }

}
