<?php

namespace App;

use App\WidgetSchedule;
use App\Agent;

class TwilioPhoneNumber {
    private $twilio_phone_number;
    private $twilio_phone_number_name;
    private	$account_id;
    private $widgetSchedule;
    private $agents;

    public function __construct( WidgetSchedule $widgetSchedule ) {
        $this->widgetSchedule = $widgetSchedule;
        $this->init();
    }

    public static function create( WidgetSchedule $widgetSchedule ) {
        return new TwilioPhoneNumber( $widgetSchedule );
    }

    private function init() {
        $widgetSchedulePhoneNumberArr = explode(':', $this->widgetSchedule->phone_number_id ) ;
        $this->account_id = $this->widgetSchedule->account->id;

        if ( $widgetSchedulePhoneNumberArr[0] === 'ap' ) {
            $agent = Agent::find( $widgetSchedulePhoneNumberArr[1] );
            $this->agents = array( $agent );
        } else if ( $widgetSchedulePhoneNumberArr[0] === 'apg' ) {
            $agentGroup = AgentGroup::find( $widgetSchedulePhoneNumberArr[1] );
            $this->agents = $agentGroup->getAgentsAsList();
        }
    }


    /**
     * @return mixed
     */
    public function getTwilioPhoneNumber() {
        return $this->twilio_phone_number;
    }

    /**
     * @return mixed
     */
    public function getTwilioPhoneNumberName() {
        return $this->twilio_phone_number_name;
    }

    /**
     * @return mixed
     */
    public function getAccountId() {
        return $this->account_id;
    }

    /**
     * @return \App\WidgetSchedule
     */
    public function getWidgetSchedule(): \App\WidgetSchedule {
        return $this->widgetSchedule;
    }

    /**
     * @return Agent[]
     */
    public function getAgents() {
        $agents = $this->agents;

        if ( null === $agents || count( $agents ) === 0 ) {
            return null;
        }

        return $agents;
    }

}
