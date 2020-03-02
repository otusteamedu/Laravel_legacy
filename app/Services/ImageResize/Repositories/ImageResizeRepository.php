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
    public function fit(string $imgPath, string $width, string $height)
    {
        return  Image::cache(function ($image) use ($imgPath, $width, $height) {
            $image->make($imgPath)->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }, $this->cacheTime, true);
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @return mixed
     */
    public function widen(string $imgPath, string $width)
    {
        return Image::cache(function ($image) use ($imgPath, $width) {
            $image
                ->make($imgPath)->widen($width, function ($constraint) {
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
     * @return mixed
     */
    public function show(string $imgPath)
    {
        return Image::make($imgPath);
    }
}
