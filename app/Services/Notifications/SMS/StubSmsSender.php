<?php
/**
 * Description of InfobipSmsSender.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Notifications\SMS;


final class StubSmsSender implements SmsSender
{

    public function __construct(

    )
    {

    }


    public function send(string $phone, string $message)
    {
        //
    }
}
