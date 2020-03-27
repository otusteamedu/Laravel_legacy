<?php

namespace App\Http\Controllers\ImageResize;

use App\Services\ImageResize\ImageResizeService;
use App\Http\Controllers\Controller;
use Image;
use File;

class ImageResizeController extends Controller
{
    /**
     * @var ImageResizeService
     */
    private $service;

    /**
     * ImageResizeController constructor.
     * @param ImageResizeService $service
     */
    public function __construct(ImageResizeService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $width
     * @param string $height
     * @param string $path
     * @return mixed
     */
    public function resize(string $width, string $height, string $path)
    {
        return $this->service->resize($width, $height, $path);
    }

    /**
     * @param string $width
     * @param string $height
     * @param string $path
     * @return mixed
     */
    public function fit(string $width, string $height, string $path)
    {
        return $this->service->fit($width, $height, $path);
    }

    /**
     * @param string $width
     * @param string $path
     * @return mixed
     */
    public function widen(string $width, string $path)
    {
        return $this->service->widen($width, $path);
    }

    /**
     * @param string $height
     * @param string $path
     * @return mixed
     */
    public function heighten(string $height, string $path)
    {
        return $this->service->heighten($height, $path);
    }

    /**
     * @param string $path
     * @return mixed
     */
    public function show(string $path)
    {
        return $this->service->show($path);
    }
}
