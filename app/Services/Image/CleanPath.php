<?php

namespace App\Services\Image;

/**
 * Class CleanPath
 * @package App\Services\Image
 */
class CleanPath
{
    /**
     * @param $path
     * @return bool
     */
    public static function cleanPath($path): bool
    {
        if (!is_dir($path)) {
            return true;
        }

        $files = array_diff(scandir($path), ['.','..']);

        foreach ($files as $file) {
            (is_dir($path . '/' . $file)) ? self::cleanPath($path.'/'.$file) : unlink($path.'/'.$file);
        }

        return rmdir($path);
    }
}