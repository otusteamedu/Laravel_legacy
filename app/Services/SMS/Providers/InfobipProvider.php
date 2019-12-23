<?php
/**
 * Description of InfobipProvider.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\SMS\Providers;


class InfobipProvider implements SMSProviderInterface
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
            'Sending sms via: Infobip', [
                $this->host,
                $this->apiToken,
                $phone,
                $text
            ]
        );
    }
}