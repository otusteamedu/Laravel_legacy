<?php


namespace App\Models\Validator;

use App\Models\Schedule\TruckSchedule;
use App\Models\Transport\Transport;

class TruckValidator implements ValidatorInterface
{
    public function isAvailable(Transport $transport, $date): bool
    {
        $result = TruckSchedule::where(['transport_id' => $transport->id])
            ->where(['date' => $date])
            ->first();

        return $result ? false : true;
    }
}
