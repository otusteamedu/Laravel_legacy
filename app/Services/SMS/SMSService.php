<?php
/**
 * Description of SMSService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\SMS;


use App\Services\SMS\Providers\SMSProviderInterface;

class SMSService
{

    /** @var SMSProviderInterface */
    private $SMSProvider;

    public function __construct(
        SMSProviderInterface $SMSProvider
    )
    {
        $this->SMSProvider = $SMSProvider;
    }

    /**
     * @param string $phone
     * @param string $message
     */
    public function send(
        string $phone,
        string $message
    )
    {
        $this->SMSProvider->send($phone, $message);
    }

}