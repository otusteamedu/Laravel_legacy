<?php

namespace SmsServiceV1;

class StatusResponse {

    private $timeCreated;
    private $delivered;
    private $error;
    private $smsActive;
    private $target; // номер телефона

    public function __construct($timeCreated, $smsActive, $delivered, $target, $error) {

        $this->timeCreated = $timeCreated;
        $this->delivered = $delivered;
        $this->error = $error;
        $this->smsActive = $smsActive;
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getError() {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getTimeCReated() {
        return $this->timeCreated;
    }

    /**
     * @return mixed
     */
    public function getDelivered() {
        return $this->delivered;
    }

    /**
     * @return mixed
     */
    public function getActive() {
        return $this->smsActive;
    }

    /**
     * @return mixed
     */
    public function getTarget() {
        return $this->target;
    }
}
