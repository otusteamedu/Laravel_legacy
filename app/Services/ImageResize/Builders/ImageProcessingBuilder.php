<?php


namespace App\Services\ImageResize\Builders;


use App\Services\ImageResize\Repositories\ImageResizeRepository;

class ImageProcessingBuilder
{
    private \Intervention\Image\Image $image;
    private ImageResizeRepository $repository;

    /**
     * ImageProcessingHandler constructor.
     * @param ImageResizeRepository $repository
     */
    public function __construct(ImageResizeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $imagePath
     * @return ImageProcessingBuilder
     */
    public function make(string $imagePath): ImageProcessingBuilder
    {
        $this->image = $this->repository->make($imagePath);

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @param int $x
     * @param int $y
     * @return ImageProcessingBuilder
     */
    public function crop(int $width, int $height, int $x, int $y): ImageProcessingBuilder
    {
        $this->image = $this->repository->cropWHXY($this->image, $width, $height, $x, $y);

        return $this;
    }

    /**
     * @param int $value
     * @return ImageProcessingBuilder
     */
    public function flip(int $value): ImageProcessingBuilder
    {
        if ($value == 1) {
            $this->image = $this->repository->flip($this->image);
        }

        return $this;
    }

    /**
     * @param string $colorize
     * @return ImageProcessingBuilder
     */
    public function colorize(string $colorize): ImageProcessingBuilder
    {
        switch ($colorize) {
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
     * @param int $width
     * @param int $height
     * @return ImageProcessingBuilder
     */
    public function resizeWithAspectRatio(int $width, int $height): ImageProcessingBuilder
    {
        $this->image = $this->repository->resizeWithAspectRatio($this->image, $width, $height);

        return $this;
    }


    /**
     * @param int $width
     * @param int $height
     * @param string $color
     * @return ImageProcessingBuilder
     */
    public function cropCanvas(int $width, int $height, string $color): ImageProcessingBuilder
    {
        $this->image = $this->repository->cropCanvas($this->image, $width, $height, $color);

        return $this;
    }

    /**
     * @return \Intervention\Image\Image
     */
    public function get(): \Intervention\Image\Image
    {
        return $this->image;
    }
}
