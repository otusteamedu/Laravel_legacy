<?php


namespace App\Models\Validator;


use App\Models\Schedule\BusSchedule;
use App\Models\Transport\Transport;


class BusValidator implements ValidatorInterface
{
    public function isAvailable(Transport $transport, $date): bool
    {
        $result = BusSchedule::where(['transport_id' => $transport->id])
            ->where(['date' => $date])
            ->first();

        return $result ? false : true;
    }
}
