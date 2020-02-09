<?php

namespace App\Services\Image;
use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;
use Str;
/**
 * Class ImageServices
 * @package App\Services\Image
 */
class ImageServices
{
    /** @var string IMAGE_UPLOAD_PATH */
    protected const IMAGE_UPLOAD_PATH = 'original';

    /** @var string[] SIZES_PREFIX */
    protected const SIZES_PREFIX = [
        'small' => '_s',
        'medium' => '_m',
        'full' => '',
    ];

    /** @var UploadedFile $uploadImage */
    protected $uploadImage;

    /** @var string $imageName */
    protected $imageName;

    /** @var string $extension */
    protected $extension;

    /** @var string $path */
    protected $path;

    /** @var int $entityId */
    protected $entityId;

    /** @var array $settings */
    protected $settings;

    /**
     * @param UploadedFile $uploadImage
     * @return $this
     */
    public function setUploadImage(UploadedFile $uploadImage): self
    {
        $this->uploadImage = $uploadImage;
        $this->extension = $this->uploadImage->extension();
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setImageName(string $name): self
    {
        $this->imageName = Str::slug($name);
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image): self
    {
        $this->imageName = \File::name($image);
        $this->extension = \File::extension($image);
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId): self
    {
        $this->entityId = $entityId;
        return $this;
    }

    /**
     * @param string $type
     * @return string
     */
    public function getImageName($type = 'full'): string
    {
        return $this->imageName . self::SIZES_PREFIX[$type] . '.' . $this->extension;
    }

    /**
     * Обрабатываем загруженное изображение
     */
    public function makeImage(): void
    {
        $this->moveImage();
        $this->setSettingImage();
        $this->resizeImage();
    }

    /**
     * Перемещаем загруженный файл в директторию сущности
     */
    protected function moveImage(): void
    {
        $this->uploadImage->move(
            $this->getEntityPath(true),
            $this->getImageName()
        );
    }

    /**
     * @param bool $upload
     * @return string
     */
    public function getEntityPath(bool $upload = false): string
    {
        return storage_path('app/public/images/' . $this->path . '/' . $this->entityId . ($upload === true ? '/' . self::IMAGE_UPLOAD_PATH : ''));
    }

    /**
     * @return string
     */
    public function getPublicPath(): string
    {
        return asset('storage/images/' . $this->path . '/' . $this->entityId);
    }

    /**
     * @todo Переделать на получение из базы
     * Устанавливаем настройики изображения
     */
    public function setSettingImage(): void
    {
        switch ($this->path) {
            case User::IMAGE_PATH:
                $this->settings = [
                    [
                        'prefix'    => self::SIZES_PREFIX['small'],
                        'width'     => 50,
                        'height'    => 50,
                        'quantity'  => 70,
                        'compression'  => 9,
                    ],
                    [
                        'prefix'    => self::SIZES_PREFIX['full'],
                        'width'     => 0,
                        'height'    => 0,
                        'quantity'  => 85,
                        'compression'  => 9,
                    ]
                ];
                break;
            case Post::IMAGE_PATH:
                $this->settings = [
                    [
                        'prefix'    => self::SIZES_PREFIX['small'],
                        'width'     => 300,
                        'height'    => 200,
                        'quantity'  => 70,
                        'compression'  => 9,
                    ],
                    [
                        'prefix'    => self::SIZES_PREFIX['medium'],
                        'width'     => 600,
                        'height'    => 400,
                        'quantity'  => 78,
                        'compression'  => 9,
                    ],
                    [
                        'prefix'    => self::SIZES_PREFIX['full'],
                        'width'     => 0,
                        'height'    => 0,
                        'quantity'  => 85,
                        'compression'  => 9,
                    ]
                ];
                break;
        }
    }

    /**
     * Обрабатываем загруженное изображение
     */
    protected function resizeImage(): void
    {
        $imagine = new Imagine();
        foreach ($this->settings as $setting) {
            $image = $imagine->open($this->getEntityPath(true) . '/' .  $this->getImageName());
            $sizes = $image->getSize();
            if ($setting['prefix'] !== '') {
                $width = (int) $setting['width'];
                $height = (int) $setting['height'];
                $scalingWidthFactor = (float) $width / $sizes->getWidth();
                $scalingHeightFactor = (float) $height / $sizes->getHeight();
                $imageHeight = (int) $sizes->getHeight() * $scalingWidthFactor;
                $imageWidth = (int) $sizes->getHeight() * $scalingHeightFactor;

                if ($imageHeight < $setting['height']) {
                    $imageHeight = $height;
                    $imageWidth = $sizes->getWidth() * $scalingHeightFactor;
                    $pointY = 0;
                    $pointX = round(($imageWidth - $setting['width']) / 2);
                }

                if ($imageWidth < $setting['width']) {
                    $imageWidth = $width;
                    $imageHeight = (int) $sizes->getHeight() * $scalingWidthFactor;
                    $pointY = round (($imageHeight - $setting['height']) / 2);
                    $pointX = 0;
                }

                $image->resize(new Box($imageWidth, $imageHeight))
                    ->crop(new Point($pointX, $pointY), new Box($setting['width'], $setting['height']));
            }
            switch ($this->extension) {
                case 'jpg':
                case 'jpeg':
                    $image->save(
                        $this->getEntityPath() . '/' . $this->imageName . $setting['prefix'] . '.' . $this->extension,
                        ['jpeg_quality' => $setting['quantity']]
                    );
                    break;
                case 'png':
                    $image->save(
                        $this->getEntityPath() . '/' . $this->imageName . $setting['prefix'] . '.' . $this->extension,
                        [
                            'png_compression_level' => $setting['compression'],
                            'png_compression_filter' => 5,
                        ]
                    );
                    break;
            }
        }
    }
}