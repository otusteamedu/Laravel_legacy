<?php
/**
 * Description of QRHelper.phper.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

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