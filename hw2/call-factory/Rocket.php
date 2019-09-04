<?php

namespace App;

use App\Widget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Основная модель. В ней содержатся все-все настройки виджета
 */
class Rocket extends Model
{
    /**
     * Совершает звонок через оператора Sipgate
     */
    public function makeSipgateCall($callee) {}

    /**
     * Совершает звонок через оператора Twilio
     */
    public function makeTwilioCall($callee) {}

    /**
     * Общий метод для совершения звонка - в зависимости от текущего оператора или один, или другой метод
     */
    public function makeCall($callee)
    {
        switch (AppSetting::getCallOperator()) {
            case 'Twilio':
                return $this->makeTwilioCall($callee);
            case 'Sipgate':
                return $this->makeSipgateCall($callee);
        }

        return null;
    }
}