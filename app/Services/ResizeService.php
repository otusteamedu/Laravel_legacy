<?php


namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * Делаем тумбы
 *
 * Class ResizeService
 * @package App\Services
 */
class ResizeService
{
    const RESIZE_PROPORTIONAL = 1;  // изменяем размер пропорционально
    const RESIZE_CROPPING = 2;      // вырезаем области в соотвествии с установками

    // варианты выравнивания вырезаемой области по горизонтали
    const CROP_HLEFT = 1;   // слева
    const CROP_HCENTER = 2; // по-центру
    const CROP_HRIGHT = 4;  // справа

    // варианты выравнивания вырезаемой области по вертикали
    const CROP_VTOP = 8;    // к верху
    const CROP_VCENTER = 16;// по-центру
    const CROP_VBOTTOM = 32;// к низу

    // по-умолчанию вырезать из середки
    const CROP_DEF = self::CROP_HCENTER | self::CROP_VCENTER;

    // временная папка
    const TMP_DIR = "/cached/";
    /**
     *  @var Filesystem
     */
    private $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }
    /**
     * Целевые параметры тумба по-умолчанию. Нормализуем $options
     * @param File $file
     * @param array $options
     * @return array
     */
    private function defaultSize(File $file, array $options): array
    {
        $arImageSize = getimagesize($file->getRealPath());
        $size = [
            'width' => $options['width'],
            'height' => $options['height']
        ];
        $width = IntVal($arImageSize[0]);
        $height = IntVal($arImageSize[1]);

        if($options['type'] == self::RESIZE_CROPPING) {
            if($options['width'] == 0 && $options['height'] == 0) {
                $size['width'] = min($width, $height);
                $size['height'] = $size['width'];
            }
            elseif($options['width'] == 0)
                $size['width'] = $size['height'];
            elseif($options['height'] == 0)
                $size['height'] = $size['width'];
        }
        else {
            if($options['width'] == 0 && $options['height'] == 0) {
                $size['width'] = $width;
                $size['height'] = $height;
            }
            elseif($options['width'] == 0)
                $size['width'] = round($width * $options['height'] / $height, 0);
            elseif($options['height'] == 0)
                $size['height'] = round($height * $options['width'] / $width, 0);
        }

        return $size;
    }

    private function getDimensions(File $file, array $options)
    {
        $options = array_merge(
            $options,
            $this->defaultSize($file, $options)
        );

        $arImageSize = getimagesize($file->getRealPath());
        $width = IntVal($arImageSize[0]);
        $height = IntVal($arImageSize[1]);

        $fromOpts = array(
            "left" => 0,
            "top" => 0,
            "width" => $width,
            "height" => $height
        );
        $toOpts = array(
            "left" => 0,
            "top" => 0,
            "width" => $options['width'],
            "height" => $options['height']
        );
        if($options['type'] == self::RESIZE_CROPPING) {
            if($width / $height > $options['width'] / $options['height']) {
                $fromOpts['height'] = $height;
                $fromOpts['width'] = $options['width'] / $options['height'] * $fromOpts['height'];
                if($options['crop_type'] & self::CROP_HLEFT)
                    $fromOpts['left'] = 0;
                elseif($options['crop_type'] & self::CROP_HRIGHT)
                    $fromOpts['left'] = $width - $fromOpts['width'];
                else
                    $fromOpts['left'] = Intval(($width - $fromOpts['width']) / 2);
            }
            else {
                $fromOpts['width'] = $width;
                $fromOpts['height'] = $options['height'] / $options['width'] * $fromOpts['width'];
                if($options['crop_type'] & self::CROP_VTOP)
                    $fromOpts['top'] = 0;
                elseif($options['crop_type'] & self::CROP_VBOTTOM)
                    $fromOpts['top'] = $height - $fromOpts['height'];
                else
                    $fromOpts['top'] = Intval(($height - $fromOpts['height']) / 2);
            }
        }

        return array($fromOpts, $toOpts);
    }
    /**
     * Имя кешированного временного файла
     * @param File $file
     * @param array $args
     * @return string
     */
    private function cachedFileName(File $file, array $args): string {
        $hash = md5(serialize($args));
        $hash = substr($hash, 0, 3);
        $uploadDirName = self::TMP_DIR;

        return $uploadDirName . $hash . "/" . $file->getFilename();
    }
    /**
     * Изменить размер публичного файла в соответствии с настройками $options
     *
     * @param File $file
     * @param array $options
     * @return File|null
     */
    public function ResizeImage(File $file, array $options): ?File
    {
        $options['type'] = isset($options['type']) ? $options['type'] : self::RESIZE_PROPORTIONAL;
        $options['crop_type'] = isset($options['crop_type']) ? $options['crop_type'] : self::CROP_DEF;
        $options['width'] = isset($options['width']) ? $options['width'] : 0;
        $options['height'] = isset($options['height']) ? $options['height'] : 0;
        if($options['type'] != self::RESIZE_PROPORTIONAL && $options['type'] != self::RESIZE_CROPPING)
            $options['type'] = self::RESIZE_PROPORTIONAL;
        $options['resize_quality'] = isset($options['resize_quality']) ? $options['resize_quality'] : 80;

        if(!$file->isFile() || !$file->isReadable())
            return null;

        list($srcSize, $dstSize) = self::getDimensions($file, $options);

        $cacheImageFile = $this->cachedFileName($file, $options);

        if ($file->getMimeType() == "image/bmp")
            $cacheImageFile .= ".jpg";

        if (!$this->storage->exists($cacheImageFile))
        {
            $hSrcImage = $this->createImage($file);
            if(!$hSrcImage)
                return null;

            $hImage = imagecreatetruecolor($dstSize["width"], $dstSize["height"]);
            $transparent_index = imagecolortransparent($hSrcImage);

            if($transparent_index >= 0) {
                // без альфа-канала
                $t_c = imagecolorsforindex($hSrcImage, $transparent_index);
                $transparent_index = imagecolorallocate($hSrcImage, $t_c['red'], $t_c['green'], $t_c['blue']);
                imagecolortransparent($hImage, $transparent_index);
            }
            else {
                // с альфа-каналом
                imagealphablending ( $hImage, false );
                imagesavealpha ( $hImage, true );
                $transparent = imagecolorallocatealpha ( $hImage, 255, 255, 255, 127 );
                imagefilledrectangle ( $hImage, 0, 0, $dstSize["width"], $dstSize["height"], $transparent);
            }

            imagecopyresampled(
                $hImage, $hSrcImage,
                $dstSize["left"], $dstSize["top"],
                $srcSize["left"], $srcSize["top"],
                $dstSize["width"], $dstSize["height"],
                $srcSize["width"], $srcSize["height"]
            );

            // self::SetWaterMark($hImage, $DST_SIZE, $arWaterMark);
            //CFile::WatermarkImage(&$obj, $Params = array());

            $this->saveImage($cacheImageFile, $hImage, $file, $options);

            @imagedestroy($hImage);
            @imagedestroy($hSrcImage);
        }

        return new File(config('filesystems.disks.public.root') . $cacheImageFile);
    }
    /**
     * Создать ресурс файла для обработки
     * @param File $file
     * @return false|resource|null
     */
    private function createImage(File $file)
    {
        $filePath = $file->getRealPath();
        $mimeType = $file->getMimeType();

        $hImage = null;
        if($mimeType == "image/gif")
            $hImage = imagecreatefromgif($filePath);
        elseif(in_array($mimeType, array("image/jpeg", "image/jpg")))
            $hImage = imagecreatefromjpeg($filePath);
        elseif(in_array($mimeType, array("image/png", "image/x-png")))
            $hImage = imagecreatefrompng($filePath);
        //elseif($mimeType == "image/bmp")
        //   надеюсь что такого не будет

        return $hImage;
    }

    /**
     * Сохранить ресурс в локальное публичное хранилище
     *
     * @param string $cachedFilePath
     * @param $hImage
     * @param File $file
     * @param array $options
     * @return bool
     */
    private function saveImage(string $cachedFilePath, $hImage, File $file, array $options): bool
    {
        $mimeType = $file->getMimeType();

        ob_start();
        if($mimeType == "image/gif")
            imagegif($hImage);
        elseif(in_array($mimeType, array("image/jpeg", "image/jpg", "image/bmp")))
            imagejpeg($hImage, null, $options['resize_quality']);
        elseif(in_array($mimeType, array("image/png", "image/x-png")))
            imagepng($hImage);
        $imageData = ob_get_contents();
        ob_end_clean();

        if($imageData) {
            $this->storage->put($cachedFilePath, $imageData);
            return true;
        }

        return false;
    }
}
