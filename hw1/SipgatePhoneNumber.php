<?php

namespace App;

use App\WidgetSchedule;
use App\SipgateDevice;
use App\Agent;

/**
 * Класс для получения информации о номере оператора Sipgate, с которого будем звонить менеджерам
 * а также о самих менеджерах, которые доступны в момент времени
 *
 * Изначально был только один оператор - Sipgate, но потом я добавил Twilio и соответственно класс TwilioPhoneNumber,
 * который скопировал с этого. Надо было сделать абстрактный класс, и его бы наследовали классы для работы с конкретным оператором.
 * И, соответственно, следовать принципу открытости/закрытости
 */
class SipgatePhoneNumber {

    private $sipgate_phone_number;
    private $sipgate_phone_number_name;
    private	$account_id;
    private	$sipgate_owner_account_id;
    private $WidgetSchedule;

    public function __construct( WidgetSchedule $widgetSchedule = null ) {
        $this->widgetSchedule = $widgetSchedule;
        $this->init();
    }

    public static function create( WidgetSchedule $widgetSchedule ) {
        return new SipgatePhoneNumber($widgetSchedule);
    }

    private function init() {
        $widgetSchedulePhoneNumberArr = explode(":",$this->widgetSchedule->phone_number_id);
        $this->account_id = $this->widgetSchedule->account->id;
        $deviceId = "";
        $caller = "";
        // снова нарушел принцип OCP
        if ($widgetSchedulePhoneNumberArr[0] == "ad") {
            $sipgateDevice = SipgateDevice::find($widgetSchedulePhoneNumberArr[1]);
            $this->sipgate_phone_number_name = $sipgateDevice->device_sipgate_name;
            if( $sipgateDevice->callcenter_type == 1 ) {
                $callcenterSipgate = json_decode($sipgateDevice->callcenter_sipgate,true);
                $caller = $callcenterSipgate["userDeviceId"];
            }
            else if( $sipgateDevice->callcenter_type == 2 ) {
                $caller = $sipgateDevice->callcenter_phone;
            }
        } else if ($widgetSchedulePhoneNumberArr[0] == "ap") {
            $sipgateDevice = SipgateDevice::query()->where("customer_account_id",$this->account_id)->first();
            $agent = Agent::find($widgetSchedulePhoneNumberArr[1]);
            $caller = $agent->account_phone;
            $this->sipgate_phone_number_name = $agent->account_phone_name;
        }
        $deviceSipgate = json_decode($sipgateDevice->device_sipgate,true);
        $this->sipgate_owner_account_id = $sipgateDevice->account_id;
        $deviceId = $deviceSipgate["phonelineId"];
        $this->sipgate_phone_number = $deviceId . ":" . $caller;
    }


    /**
     * @return mixed
     */
    public function getSipgatePhoneNumber() {
        return $this->sipgate_phone_number;
    }

    /**
     * @return mixed
     */
    public function getSipgatePhoneNumberName() {
        return $this->sipgate_phone_number_name;
    }

    /**
     * @return mixed
     */
    public function getAccountId() {
        return $this->account_id;
    }

    /**
     * @return mixed
     */
    public function getSipgateOwnerAccountId() {
        return $this->sipgate_owner_account_id;
    }

    /**
     * @return \App\WidgetSchedule
     */
    public function getWidgetSchedule(): \App\WidgetSchedule {
        return $this->WidgetSchedule;
    }

    /**
     * Check if agent is currently talking
     *
     * @return bool
     */
    public function isLive() {
        $sipgateClient = SipgateClient::getSipgateClient( $this );
        $liveCalls = $sipgateClient->getLiveCalls();

        if ( count( $liveCalls ) > 0 ) {
            foreach ( $liveCalls as $call ) {
                $callerNumber = $sipgateClient->getLiveCallCallerNumber( $call );

                if ( $this->sipgate_phone_number === $callerNumber ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Global check if agent is ready to talk with client
     * Contains multiple checks
     *
     * @return bool
     */
    public function isFree() {
        return ! $this->isLive();
    }

}
