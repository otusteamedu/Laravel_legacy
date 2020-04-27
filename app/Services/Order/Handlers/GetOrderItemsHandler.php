<?php


namespace App\Services\Order\Handlers;


use App\Services\Image\CmsImageService;
use App\Services\Texture\CmsTextureService;

class GetOrderItemsHandler
{
    private CmsImageService $imageService;
    private CmsTextureService $textureService;

    /**
     * GetOrderItemsHandler constructor.
     * @param CmsImageService $imageService
     * @param CmsTextureService $textureService
     */
    public function __construct(
        CmsImageService $imageService,
        CmsTextureService $textureService
    )
    {
        $this->imageService = $imageService;
        $this->textureService = $textureService;
    }

    /**
     * @param array $requestItems
     * @return array
     */
    public function handle(array $requestItems): array
    {
        return array_map(function($item) {
            $item['imagePath'] = $this->getImagePath($item);
            $item['thumbPath'] = $this->getImageThumbPath($item);

            $texture = $this->textureService->getItem($item['texture']);

            $item['texture'] = [
                'id' => $texture->id,
                'name' => $texture->name,
                'price' => $texture->price
            ];

            $item['price'] = $this->getItemPrice($item['width'], $item['height'], $texture->price);

            return $item;
        }, $requestItems);
    }

    /**
     * @param int $width
     * @param int $height
     * @param int $texturePrice
     * @return int
     */
    private function getItemPrice(int $width, int $height, int $texturePrice): int
    {
        return (int) round($width * $height / 1e6 * $texturePrice, 0) * 100;
    }

    /**
     * @param array $item
     * @return string
     */
    private function getImagePath(array $item)
    {
        return '/image/order-item-full' . $this->getImageBasePath($item);
    }

    /**
     * @param array $item
     * @return string
     */
    private function getImageThumbPath(array $item)
    {
        return '/image/order-item-thumb' . $this->getImageBasePath($item);
    }

    /**
     * @param array $item
     * @return string
     */
    private function getImageBasePath(array $item): string
    {
        $w = $item['cropWidth'];
        $h = $item['cropHeight'];
        $x = $item['x'];
        $y = $item['y'];
        $flip = (int) $item['filter']['flip'];
        $colorize = !!$item['filter']['colorize'] ? $item['filter']['colorize'] : 0;
        $name = $this->imageService->getItem($item['imageId'])->path;

        return '/' . $w . '/' . $h . '/' . $x . '/' . $y . '/' . $flip . '/' . $colorize . '/' . $name;
    }
}
