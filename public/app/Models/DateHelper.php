<?php

namespace App\Models;

use DateInterval;
use \DateTime;

class DateHelper
{
    public static function shiftTime($shift, $date)
    {
        $shiftTime = new DateTime($date);
        $shiftTime->add(new DateInterval("PT{$shift}H"));

        return $shiftTime->format('Y-m-d H:i');
    }

    public static function getHours($date)
    {
        return (new DateTime($date))->format('H');
    }
}
