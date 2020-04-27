<?php

use App\Services\Uploader\ImageValidationBuilder;
use App\Services\User\UserValidator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Services\Uploader\Uploader;
use Faker\Generator as Faker;
use Tymon\JWTAuth\JWTAuth;

if (! function_exists('getUploadedFileFromPath')) {
    function getUploadedFileFromPath(string $path, bool $public = false)
    {
        $name = File::name($path);
        $extension = File::extension($path);
        $originalName = $name . '.' . $extension;
        $mimeType = File::mimeType($path);
//        $size = File::size($path); // Deprecated: since from v7.0
        $error = null;
        $test = $public;

        return new UploadedFile($path, $originalName, $mimeType, $error, $test);
    }
}

if (! function_exists('uploader')) {
    function uploader()
    {
        return app()->make(Uploader::class);
    }
}

if (! function_exists('imageValidationBuilder')) {
    function imageValidationBuilder()
    {
        return app()->make(ImageValidationBuilder::class);
    }
}

if (! function_exists('isImageValid')) {
    function isImageValid($upload, array $uploadRules = null)
    {
        if (!$upload) {
            return false;
        }
        $rules = $uploadRules ?? config('uploads.image_upload_rules');
        $fileProps = [
            "original_name" => File::name($upload),
            "extension" => File::extension($upload),
            "mime" => File::mimeType($upload),
            "size" => File::size($upload)
        ];

        return imageValidationBuilder()
            ->init($fileProps, $rules, false)
            ->isAllowExtension()
            ->isAllowMime()
            ->isAllowMinSize()
            ->isAllowMaxSize()
            ->isAllow();
    }
}

if (! function_exists('faker')) {
    function faker()
    {
        return app()->make(Faker::class);
    }
}

if (! function_exists('getFakerImage')) {
    /**
     * @param int $with
     * @param int $height
     * @param string|null $category
     * @return UploadedFile|null
     */
    function getFakerImage(int $with = 600, int $height = 480, string $category = null)
    {
        $uploadedImage = null;

        while (!isImageValid($uploadedImage)) {
            $uploadedImage = getUploadedFileFromPath(faker()->image(null, $with, $height, $category), true);
        }

        return $uploadedImage;
    }
}

if (! function_exists('getFakerImageFromLocal')) {
    /**
     * @param array $images
     * @param string $seedsUploadImageDir
     * @param string $seedsImageDir
     * @return UploadedFile|null
     */
    function getFakerImageFromLocal(array $images, string $seedsUploadImageDir, string $seedsImageDir)
    {
        $firstImagesIndex = key($images);

        $randIndex = rand($firstImagesIndex, count($images) - 1);
        $randImage = $images[$randIndex];

        $sourceImage = $seedsUploadImageDir . '/' . $randImage;
        $destImage = $seedsImageDir . $randImage;

        copy($sourceImage, $destImage);

        return isImageValid($destImage)
            ? getUploadedFileFromPath($destImage, true)
            : null;
    }
}

if (! function_exists('getImageByNameFromLocal')) {
    /**
     * @param array $images
     * @param string $name
     * @param string $seedsUploadImageDir
     * @param string $seedsImageDir
     * @return UploadedFile|null
     */
    function getImageByNameFromLocal(array $images, string $name, string $seedsUploadImageDir, string $seedsImageDir)
    {
        $image = Arr::first($images, function ($value, $key) use ($name) {
            return $value === $name;
        });

        if (! $image) {
            abort(404, 'SeedsException: Image with name "' . $name . '" not found');
        }

        $sourceImage = $seedsUploadImageDir . '/' . $image;
        $destImage = $seedsImageDir . $image;

        copy($sourceImage, $destImage);

        return isImageValid($destImage)
            ? getUploadedFileFromPath($destImage, true)
            : null;
    }
}

if (! function_exists('getImagesFromLocal')) {
    /**
     * @param string $dir
     * @return array
     */
    function getImagesFromLocal(string $dir): array
    {
        $files = scandir($dir);

        return array_filter($files, function ($file) use ($dir) {
            return isImageValid(($dir . '/' . $file));
        });
    }
}

if (! function_exists('jwtAuth')) {
    function jwtAuth()
    {
        return app()->make(JWTAuth::class);
    }
}

if (! function_exists('getImageArticle')) {
    function getImageArticle(int $id)
    {
        return str_pad($id, config('settings.image_article_length'), "0", STR_PAD_LEFT);
    }
}

if (! function_exists('wordsDeclension')) {
    function wordsDeclension(int $n, array $words)
    {
        return ( $words[($n = ($n = $n % 100) > 19 ? ($n % 10) : $n) == 1 ? 0 : (($n > 1 && $n <= 4) ? 1 : 2 )]);
    }
}

if (! function_exists('phoneFormat')) {
    function phoneFormat($phone, $format, $mask = '#')
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (is_array($format)) {
            if (array_key_exists(strlen($phone), $format)) {
                $format = $format[strlen($phone)];
            } else {
                return false;
            }
        }

        $pattern = '/' . str_repeat('([0-9])?', substr_count($format, $mask)) . '(.*)/';

        $format = preg_replace_callback(
            str_replace('#', $mask, '/([#])/'),
            function () use (&$counter) {
                return '${' . (++$counter) . '}';
            },
            $format
        );

        return ($phone) ? trim(preg_replace($pattern, $format, $phone, 1)) : false;
    }
}
