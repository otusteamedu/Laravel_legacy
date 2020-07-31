<?php
/**
 * Description of SmsSender.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Notifications\SMS;


interface SmsSender
{

    public function send(string $phone, string $message);

}
