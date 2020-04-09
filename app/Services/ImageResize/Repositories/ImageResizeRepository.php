<?php


namespace App\Services\ImageResize\Repositories;

use Image;

class ImageResizeRepository
{
    /**
     * Image caching time
     */
    private int $cacheTime;

    /**
     * GetImageResizeHandler constructor.
     */
    public function __construct()
    {
        $this->cacheTime = config('uploads.image_cache_time');
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @param string $height
     * @return mixed
     */
    public function resize(string $imgPath, string $width, string $height)
    {
        return Image::cache(function ($image) use ($imgPath, $width, $height) {
            $image->make($imgPath)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @param string $height
     * @return mixed
     */
    public function crop(string $imgPath, string $width, string $height)
    {
        return Image::cache(function ($image) use ($imgPath, $width, $height) {
            $image->make($imgPath)->crop($width, $height);
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @param string $height
     * @param string $x
     * @param string $y
     * @return \Intervention\Image\Image
     */
    public function orderCrop(string $imgPath, string $width, string $height, string $x, string $y)
    {
        return Image::cache(function ($image) use ($imgPath, $width, $height, $x, $y) {
            $image->make($imgPath)->crop($width, $height, $x, $y);
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @param string $height
     * @return mixed
     */
    public function fit(string $imgPath, string $width, string $height)
    {
        return  Image::cache(function ($image) use ($imgPath, $width, $height) {
            $image->make($imgPath)->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }, $this->cacheTime, true);
    }

    /**
     * @param \Intervention\Image\Image $image
     * @param int $width
     * @param int $height
     * @param string $color
     * @return \Intervention\Image\Image
     */
    public function cropCanvas(\Intervention\Image\Image $image, int $width, int $height, string $color): \Intervention\Image\Image
    {
        return $image->resizeCanvas($width, $height, 'center', false, $color);
    }

    /**
     * @param \Intervention\Image\Image $image
     * @param int $width
     * @param int $height
     * @return \Intervention\Image\Image
     */
    public function resizeWithAspectRatio(\Intervention\Image\Image $image, int $width, int $height): \Intervention\Image\Image
    {
        return $image->resize($width, $height, function($image) {
            $image->aspectRatio();
        });
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @return mixed
     */
    public function widen(string $imgPath, string $width)
    {
        return Image::cache(function ($image) use ($imgPath, $width) {
            $image->make($imgPath)->widen($width, function ($constraint) {
                $constraint->upsize();
            });
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @param string $height
     * @return mixed
     */
    public function heighten(string $imgPath, string $height)
    {
        return Image::cache(function ($image) use ($imgPath, $height) {
            $image->make($imgPath)->heighten($height, function ($constraint) {
                $constraint->upsize();
            });
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @return \Intervention\Image\Image
     */
    public function show(string $imgPath)
    {
        return Image::make($imgPath);
    }

    /**
     * @param string $imgPath
     * @return mixed
     */
    public function showGrayscale(string $imgPath)
    {
        return Image::cache(function ($image) use ($imgPath) {
            $image->make($imgPath)->greyscale();
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imagePath
     * @return \Intervention\Image\Image
     */
    public function make(string $imagePath): \Intervention\Image\Image
    {
        return Image::make($imagePath);
    }

    /**
     * @param \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function flip(\Intervention\Image\Image $image): \Intervention\Image\Image
    {
        return $image->flip();
    }

    /**
     * @param \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function grayscale(\Intervention\Image\Image $image): \Intervention\Image\Image
    {
        return $image->greyscale();
    }

    /**
     * @param \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function sepia(\Intervention\Image\Image $image): \Intervention\Image\Image
    {
        return $image
            ->brightness(-5)
            ->contrast(3)
            ->greyscale()
            ->colorize(13, 9, 3);
    }

    /**
     * @param \Intervention\Image\Image $image
     * @param string $width
     * @param string $height
     * @param string $x
     * @param string $y
     * @return \Intervention\Image\Image
     */
    public function cropWHXY(
        \Intervention\Image\Image $image,
        string $width,
        string $height,
        string $x,
        string $y): \Intervention\Image\Image
    {
        return $image->crop($width, $height, $x, $y);
    }
}
