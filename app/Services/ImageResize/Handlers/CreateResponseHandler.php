<?php


namespace App\Services\ImageResize\Handlers;


class CreateResponseHandler
{
    /**
     * Image quality after resize
     */
    private $quality;

    /**
     * Image caching time
     */
    private $cacheTime;

    /**
     * GetImageResizeHandler constructor.
     */
    public function __construct()
    {
        $this->quality = config('uploads.image_resize_quality');
        $this->cacheTime = config('uploads.image_cache_time');
    }

    /**
     * @param $imgObj
     * @param string $ext
     * @return mixed
     */
    public function handle($imgObj, $ext = 'jpg')
    {
        return $imgObj->response($ext, $this->quality)
            ->header('Cache-Control', 'public, max-age=' . $this->cacheTime);
    }
}
