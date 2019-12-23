<?php
/**
 * Description of SMSProviderInterface.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\SMS\Providers;


interface SMSProviderInterface
{

    public function send(string $phone, string $text): void;

}