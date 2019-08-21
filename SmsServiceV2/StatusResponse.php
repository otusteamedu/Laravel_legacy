<?php

namespace SmsServiceV2;

class StatusResponse {

    private $timeCreated;
    private $delivered;
    private $error;
    private $smsActive;
    private $target; // номер телефона

    public function __construct(StatusResponseBuilder $builder) {
        $this->timeCreated = $builder->getTimeCreate();
        $this->delivered = $builder->getDeliveryStatus();
        $this->error = $builder->getError();
        $this->smsActive = $builder->getSmsActiveStatus();
        $this->target = $builder->getTarget();
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
