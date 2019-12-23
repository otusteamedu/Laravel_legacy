<?php
/**
 * Description of TurboSMSProvider.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\SMS\Providers;


class TurboSMSProvider implements SMSProviderInterface
{

    private $host;
    private $username;
    private $password;

    public function __construct(
        string $host,
        string $username,
        string $password
    )
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function send(string $phone, string $text): void
    {
        \Log::info(
            'Sending sms via: TurboSMS', [
                $this->host,
                $this->username,
                $this->password,
                $phone,
                $text
            ]
        );
    }

}