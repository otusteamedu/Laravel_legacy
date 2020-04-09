<?php


namespace App\Services\CDEK\Handlers;

use App\Services\Setting\CmsSettingService;
use CdekSDK\Requests;

class GetPriceHandler
{
    private CmsSettingService $settingService;
    private $senderPostCode;
    private \CdekSDK\CdekClient $client;
    private $packageWeight;
    private $packageHeight;
    private $packageWidth;
    private $packageLength;


    /**
     * GetPriceHandler constructor.
     * @param CmsSettingService $settingService
     */
    public function __construct(
        CmsSettingService $settingService
    )
    {
        $this->settingService = $settingService;
        $this->client = new \CdekSDK\CdekClient(
            env('CDEK_ACCOUNT'),
            env('CDEK_PASSWORD'),
            new \GuzzleHttp\Client([
                'base_uri' => 'https://integration.edu.cdek.ru',
            ])
        );
        $this->senderPostCode =
            $this->settingService->getItemValueByKey(config('cdek.post_code_setting_key')) ??
            config('cdek.default_post_code');
        $this->packageWeight =
            $this->settingService->getItemValueByKey(config('cdek.package.weight')) ??
            config('cdek.package.weight');
        $this->packageHeight =
            $this->settingService->getItemValueByKey(config('cdek.package.dimensions.height')) ??
            config('cdek.package.dimensions.height');
        $this->packageWidth =
            $this->settingService->getItemValueByKey(config('cdek.package.dimensions.width')) ??
            config('cdek.package.dimensions.width');
        $this->packageLength =
            $this->settingService->getItemValueByKey(config('cdek.package.dimensions.length')) ??
            config('cdek.package.dimensions.length');
    }

    /**
     * @param string|array $query
     * @return int
     */
    public function handle($query): int
    {
        return is_array($query)
            ? $this->calculatePriceFromCodeList($query)
            : $this->calculatePriceFromCode($query);
    }

    /**
     * @param array $codes
     * @return int
     */
    private function calculatePriceFromCodeList (array $codes): int
    {
        $price = 0;
        $response = null;

        foreach ($codes as $code) {
            $response = $this->getCalculationResponse($code);
            if ($response) {
                $price = round((int) $response->getPrice(), 0);
                break;
            }
        }

        return $price;
    }

    /**
     * @param string $code
     * @return int
     */
    private function calculatePriceFromCode(string $code): int
    {
        $response = $this->getCalculationResponse($code);

        return $response ? round((int) $response->getPrice(), 0) : 0;
    }

    /**
     * @param string $code
     * @return \CdekSDK\Responses\CalculationResponse|null
     */
    private function getCalculationResponse(string $code)
    {
        $request = $this->getCalculationAuthorizedRequest($code);
        $response = $this->client->sendCalculationRequest($request);

        if (!$response->hasErrors()) {
            return $response;
        }

        return null;
    }

    /**
     * @param string $code
     * @return Requests\CalculationAuthorizedRequest
     */
    private function getCalculationAuthorizedRequest(string $code)
    {
        $request = new Requests\CalculationAuthorizedRequest();

        $request->setSenderCityPostCode($this->senderPostCode)
            ->setReceiverCityPostCode($code)
            ->setTariffId(1)
            ->addPackage([
                'weight' => $this->packageWeight,
                'length' => $this->packageLength,
                'width'  => $this->packageWidth,
                'height' => $this->packageHeight
            ]);

        return $request;
    }
}
