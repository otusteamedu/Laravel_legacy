<?php


namespace App\Helpers;


class QRHelper
{
    /**
     * @param string $outputFilename
     * @return string
     */
    public static function getQRFilePath(string $outputFilename): string
    {
        return storage_path('app/public/qr/' . $outputFilename);
    }
}
