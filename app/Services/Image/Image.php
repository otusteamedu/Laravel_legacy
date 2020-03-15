<?php

namespace App\Services\Image;

/**
 * Trait Image
 * @package App\Services\Image
 */
trait Image
{
    /**
     * @param int $id
     * @param string $path
     * @param string $image
     * @param string $type
     * @return array
     */
    protected function getImage(int $id, string $path, string $image, string $type): array
    {
        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);
        $imageService->setPath($path)
            ->setImage($image)
            ->setEntityId($id);
        return [
            'path' => $imageService->getPublicPath(),
            'image' => $imageService->getImageName($type),
        ];
    }
}