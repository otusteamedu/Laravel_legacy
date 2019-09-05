<?php

namespace App;

use App\Widget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Основная модель. В ней содержатся все-все настройки виджета
 */
class RocketRefactored extends Model
{
    /**
     * Общий метод для совершения звонка - в зависимости от текущего оператора или один, или другой метод
     *
     * @param  string  $from
     * @param  string  $to
     *
     * @return bool|null
     */
    public function makeCall(string $from, string $to): ?bool
    {
        switch (App::getCallOperator()) {
            case 'Twilio':
                $caller = new TwilioCaller($this->twilioToken, $this->twilioPassword);

                break;
            case 'Sipgate':
                $caller = new SipgateCaller($this->sipgateAccountId, $this->sipgatePassword);

                break;
            default:
                return false;
        }

        $caller->call($from, $to);
    }
}