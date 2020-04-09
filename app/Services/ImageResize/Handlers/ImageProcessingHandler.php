<?php


namespace App\Services\ImageResize\Handlers;


use App\Services\ImageResize\Repositories\ImageResizeRepository;
use Image;

class ImageProcessingHandler
{
    private int $cacheTime;
    private \Intervention\Image\Image $image;
    private string $imgPath = '';
    private string $width = '';
    private string $height = '';
    private string $x = '';
    private string $y = '';
    private string $flip = '';
    private string $colorize = '';

    private const CANVAS_COLOR = 'E8E8E8';
    private const CANVAS_WITH = 600;
    private const CANVAS_HEIGHT = 400;

    private ImageResizeRepository $repository;

    /**
     * ImageProcessingHandler constructor.
     * @param ImageResizeRepository $repository
     */
    public function __construct(ImageResizeRepository $repository)
    {
        $this->repository = $repository;
        $this->cacheTime = config('uploads.image_cache_time');
    }

    public function handle(
        string $imgPath,
        string $width,
        string $height,
        string $x,
        string $y,
        string $flip,
        string $colorize
    )
    {
        $this
            ->init($imgPath, $width, $height, $x, $y, $flip, $colorize)
            ->make()
            ->flip()
            ->crop()
            ->colorize()
            ->resizeWithAspectRatio()
            ->cropCanvas();

        return $this->image;
    }

    /**
     * @param string $imgPath
     * @param string $width
     * @param string $height
     * @param string $x
     * @param string $y
     * @param string $flip
     * @param string $colorize
     * @return ImageProcessingHandler
     */
    protected function init(
        string $imgPath,
        string $width,
        string $height,
        string $x,
        string $y,
        string $flip,
        string $colorize
    ): ImageProcessingHandler
    {
        $this->imgPath = $imgPath;
        $this->width = $width;
        $this->height = $height;
        $this->x = $x;
        $this->y = $y;
        $this->flip = $flip;
        $this->colorize = $colorize;

        return $this;
    }

    /**
     * @return ImageProcessingHandler
     */
    protected function make(): ImageProcessingHandler
    {
        $this->image = $this->repository->make($this->imgPath);

        return $this;
    }

    /**
     * @return ImageProcessingHandler
     */
    protected function crop(): ImageProcessingHandler
    {
        $this->image = $this->repository->cropWHXY($this->image, $this->width, $this->height, $this->x, $this->y);

        return $this;
    }

    /**
     * @return ImageProcessingHandler
     */
    protected function flip(): ImageProcessingHandler
    {
        if ($this->flip == 1) {
            $this->image = $this->repository->flip($this->image);
        }

        return $this;
    }

    /**
     * @return ImageProcessingHandler
     */
    protected function colorize(): ImageProcessingHandler
    {
        switch ($this->colorize) {
            case 'grayscale':
                $this->image = $this->repository->grayscale($this->image);
                break;
            case 'sepia':
                $this->image = $this->repository->sepia($this->image);
                break;
        }

        return $this;
    }

    /**
     * @return ImageProcessingHandler
     */
    protected function resizeWithAspectRatio(): ImageProcessingHandler
    {
        $this->image = $this->repository->resizeWithAspectRatio(
            $this->image,
            self::CANVAS_WITH,
            self::CANVAS_HEIGHT
        );

        return $this;
    }


    /**
     * @return ImageProcessingHandler
     */
    protected function cropCanvas(): ImageProcessingHandler
    {
        $this->image = $this->repository->cropCanvas(
            $this->image,
            self::CANVAS_WITH,
            self::CANVAS_HEIGHT,
            self::CANVAS_COLOR
        );

        return $this;
    }
}
