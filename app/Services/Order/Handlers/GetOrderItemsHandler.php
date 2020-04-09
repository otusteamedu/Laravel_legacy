<?php


namespace App\Services\Order\Handlers;


use App\Services\Texture\CmsTextureService;

class GetOrderItemsHandler
{
    private CmsTextureService $textureService;

    /**
     * GetOrderItemsHandler constructor.
     * @param CmsTextureService $textureService
     */
    public function __construct(CmsTextureService $textureService)
    {
        $this->textureService = $textureService;
    }

    /**
     * @param array $requestItems
     * @return array
     */
    public function handle(array $requestItems): array
    {
        return array_map(function($item) {
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
}
