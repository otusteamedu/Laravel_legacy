<?php

namespace Gerfey\BattleNet\Http;

use Gerfey\BattleNet\Regions\RegionInterface;
use Gerfey\BattleNet\Traits\Utils;
use GuzzleHttp\Client;

class BattleNetClient extends HttpClient
{
    use Utils;

    /**
     * @var string
     */
    private $access_token;

    /**
     * @var RegionInterface
     */
    private $region;

    /**
     * @var string
     */
    private $namespace = '';

    /**
     * BattleNetClient constructor.
     * @param RegionInterface $region
     * @param string $access_token
     */
    public function __construct(RegionInterface $region, string $access_token)
    {
        $this->access_token = $access_token;
        $this->region = $region;

        $this->client = new Client([
            'http_errors' => false,
            'verify' => $this->verify,
            'base_uri' => $this->region->getBaseUrl()
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed|void
     */
    public function createRequest(string $method = 'GET', string $uri = '', array $options = []) : BattleNetResponseInterface
    {
        try {
            $this->response = $this->client->request($method, $uri, $this->getQueryOptions($options));
            return new BattleNetResponse($this->response);
        } catch (ClientException $e) {
            return new BattleNetResponse($this->response);
        }
    }

    /**
     * @param string $url
     * @return mixed|void
     */
    public function createRequestToBlizzardApiReference(string $url)
    {
        $url = $this->parseBlizzardApiReference($url);
        $this->setNamespace($url['namespace']);
        return $this->createRequest('GET', $url['url']);
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace = 'dynamic'): void
    {
        if (in_array($namespace, ['static', 'dynamic', 'profile'])) {
            $this->namespace = $namespace . '-' . $this->region->getLocale()->getRegion();
        } else {
            $this->namespace = 'dynamic' . '-' . $this->region->getLocale()->getRegion();
        }
    }

    /**
     * @param array $options
     * @return array
     */
    private function getQueryOptions(array $options = []): array
    {
        $this->options['query'] = array_merge($options, $this->getDefaultOptions());
        return $this->options;
    }

    /**
     * @return array
     */
    private function getDefaultOptions(): array
    {
        return [
            'namespace' => $this->namespace,
            'locale' => $this->region->getLocale()->getLocaleName(),
            'access_token' => $this->access_token,
        ];
    }
}