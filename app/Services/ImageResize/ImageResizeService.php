<?php

namespace App\Services\ImageResize;

use App\Services\ImageResize\Handlers\CreateResponseHandler;
use App\Services\ImageResize\Handlers\GetOrderImageHandler;
use App\Services\ImageResize\Handlers\GetOrderImageThumbHandler;
use App\Services\ImageResize\Handlers\GetPathExtensionHandler;
use App\Services\ImageResize\Repositories\ImageResizeRepository;

class ImageResizeService
{
    private ImageResizeRepository $repository;
    private GetPathExtensionHandler $pathExtensionHandler;
    private CreateResponseHandler $createResponseHandler;
    private GetOrderImageHandler $getOrderImageHandler;
    private GetOrderImageThumbHandler $getOrderImageThumbHandler;


    /**
     * ImageResizeService constructor.
     * @param ImageResizeRepository $repository
     * @param GetPathExtensionHandler $getPathExtensionHandler
     * @param CreateResponseHandler $createResponseHandler
     * @param GetOrderImageHandler $getOrderImageHandler
     * @param GetOrderImageThumbHandler $getOrderImageThumbHandler
     */
    public function __construct(
        ImageResizeRepository $repository,
        GetPathExtensionHandler $getPathExtensionHandler,
        CreateResponseHandler $createResponseHandler,
        GetOrderImageHandler $getOrderImageHandler,
        GetOrderImageThumbHandler $getOrderImageThumbHandler
    )
    {
        $this->repository = $repository;
        $this->pathExtensionHandler = $getPathExtensionHandler;
        $this->createResponseHandler = $createResponseHandler;
        $this->getOrderImageHandler = $getOrderImageHandler;
        $this->getOrderImageThumbHandler = $getOrderImageThumbHandler;
    }

    /**
     * @param string $width
     * @param string $height
     * @param string $path
     * @return mixed
     */
    public function resize(string $width, string $height, string $path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->resize($imgPath, $width, $height);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param string $width
     * @param string $height
     * @param string $path
     * @return mixed
     */
    public function crop(string $width, string $height, string $path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->crop($imgPath, $width, $height);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param string $path
     * @param string $width
     * @param string $height
     * @param string $x
     * @param string $y
     * @param string $flip
     * @param string $colorize
     * @return mixed
     */
    public function getOrderImage(
        string $path,
        string $width,
        string $height,
        string $x,
        string $y,
        string $flip,
        string $colorize
    )
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);

        $img = $this->getOrderImageHandler->handle($imgPath, $width, $height, $x, $y, $flip, $colorize);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param string $path
     * @param string $width
     * @param string $height
     * @param string $x
     * @param string $y
     * @param string $flip
     * @param string $colorize
     * @return mixed
     */
    public function getOrderImageThumb(
        string $path,
        string $width,
        string $height,
        string $x,
        string $y,
        string $flip,
        string $colorize
    )
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);

        $img = $this->getOrderImageThumbHandler->handle($imgPath, $width, $height, $x, $y, $flip, $colorize);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param $width
     * @param $height
     * @param $path
     * @return mixed
     */
    public function fit($width, $height, $path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->fit($imgPath, $width, $height);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param $width
     * @param $path
     * @return mixed
     */
    public function widen($width, $path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->widen($imgPath, $width);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param $height
     * @param $path
     * @return mixed
     */
    public function heighten($height, $path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->heighten($imgPath, $height);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function show($path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->show($imgPath);

        return $this->createResponseHandler->handle($img, $ext);
    }

    /**
     * @param $path
     * @return mixed
     */
    public function showGrayscale($path)
    {
        list($imgPath, $ext) = $this->pathExtensionHandler->handle($path);
        $img = $this->repository->showGrayscale($imgPath);

        return $this->createResponseHandler->handle($img, $ext);
    }
}
