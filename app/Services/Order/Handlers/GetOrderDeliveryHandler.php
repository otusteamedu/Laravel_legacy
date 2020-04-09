<?php


namespace App\Services\Order\Handlers;



use App\Models\Delivery;
use App\Services\CDEK\Handlers\GetPriceHandler;
use App\Services\Delivery\CmsDeliveryService;

class GetOrderDeliveryHandler
{
    private CmsDeliveryService $deliveryService;
    private GetPriceHandler $getPriceHandler;
    private string $pickupAlias;
    private string $cdekAlias;
    private string $cdekCourierAlias;

    /**
     * GetOrderDeliveryHandler constructor.
     * @param CmsDeliveryService $deliveryService
     * @param GetPriceHandler $getPriceHandler
     */
    public function __construct(
        CmsDeliveryService $deliveryService,
        GetPriceHandler $getPriceHandler
    )
    {
        $this->deliveryService = $deliveryService;
        $this->getPriceHandler = $getPriceHandler;
        $this->pickupAlias = config('delivery.alias.pickup');
        $this->cdekAlias = config('delivery.alias.cdek');
        $this->cdekCourierAlias = config('delivery.alias.cdek_courier');
    }

    /**
     * @param array $requestDelivery
     * @return array
     */
    public function handle(array $requestDelivery): array
    {
        $delivery = $this->deliveryService->getItem($requestDelivery['id']);

        return $this->getDeliveryInfo($delivery, $requestDelivery);
    }

    /**
     * @param Delivery $delivery
     * @param array $requestDelivery
     * @return array
     */
    private function getDeliveryInfo(Delivery $delivery, array $requestDelivery): array
    {
        switch ($delivery->alias) {
            case $this->pickupAlias:
                return $this->getPickupInfo($delivery->title, $requestDelivery);
            case $this->cdekAlias:
                return $this->getCDEKInfo($delivery->title, $requestDelivery);
            case $this->cdekCourierAlias:
                return $this->getCDEKCourierInfo($delivery->title, $requestDelivery);
            default:
                return [];
        }
    }

    /**
     * @param string $title
     * @param array $requestDelivery
     * @return array
     */
    private function getPickupInfo(string $title, array $requestDelivery): array
    {
        return [
            'title' => $title,
            'region' => config('delivery.pickup_default_region'),
            'address' => ucfirst($requestDelivery['pickup']),
            'price' => 0
        ];
    }

    /**
     * @param string $title
     * @param array $requestDelivery
     * @return array
     */
    private function getCDEKInfo(string $title, array $requestDelivery): array
    {
        return [
            'title' => $title,
            'region' => $this->getLocalityString($requestDelivery['locality']),
            'address' => ucfirst($requestDelivery['pvz']['address']),
            'price' => $this->getPrice($requestDelivery['pvz']['postal_code']) ?? $requestDelivery['price']
        ];
    }

    /**
     * @param string $title
     * @param array $requestDelivery
     * @return array
     */
    private function getCDEKCourierInfo(string $title, array $requestDelivery): array
    {
        return [
            'title' => $title,
            'region' => $this->getLocalityString($requestDelivery['locality']),
            'address' => ucfirst($requestDelivery['street']) . ', ' . $requestDelivery['apartments'],
            'price' => $this->getPrice($requestDelivery['locality']['postCodeArray']) ?? $requestDelivery['price']
        ];
    }

    /**
     * @param string|array $query
     * @return int
     */
    private function getPrice($query): int
    {
        return $this->getPriceHandler->handle($query);
    }

    /**
     * @param array $locality
     * @return string
     */
    private function getLocalityString (array $locality): string
    {
        return $locality['countryName'] . ', ' . $locality['regionName'] . ', ' . $locality['cityName'];
    }
}
