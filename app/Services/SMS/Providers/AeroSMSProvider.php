<?php
/**
 * Description of AeroSMSProvider.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\SMS\Providers;


class AeroSMSProvider implements SMSProviderInterface
{
    private $host;
    private $apiToken;

    public function __construct(
        string $host = '',
        string $apiToken = ''
    )
    {
        $this->host = $host;
        $this->apiToken = $apiToken;
    }

    public function send(string $phone, string $text): void
    {
        \Log::info(
            'Sending sms via: Aero', [
                $this->host,
                $this->apiToken,
                $phone,
                $text
            ]
        );
    }
}