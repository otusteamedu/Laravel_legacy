<?php


namespace SmsServiceV2;


class StatusResponseBuilder {
    private $timeCreated;
    private $deliveryStatus;
    private $error;
    private $smsActiveStatus;
    private $target;


    public function setTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;
        return $this;
    }

    public function setDeliveryStatus($deliveryStatus) {
        $this->deliveryStatus = $deliveryStatus;
        return $this;
    }

    public function setError($error) {
        $this->error = $error;
        return $this;
    }

    public function setSmsActiveStatus($smsActiveStatus) {
        $this->smsActiveStatus = $smsActiveStatus;
        return $this;
    }

    public function setTarget($target) {
        $this->target = $target;
        return $this;
    }


    public function built() {

        $this->validate();

        if (!empty($this->error)) {
            throw new \RuntimeException(implode(';' , $this->error));
        }
        return StatusResponse::build($this);
    }

    private function validate() {

        if ($this->timeCreated === null ) {
            $this->error[] = 'Не передана дата';
        }
        if (!is_a($this->timeCreated, \DateTime::class) ) {
            $this->error[] = 'Передан не верный тип даты';
        }

        if (empty($this->smsActiveStatus)) {
            $this->error[] = 'Не задан статус активности смс';
        }

        if (empty($this->target)) {
            $this->error[] = 'Не задан номер телефона для отправки смс';
        }

    }


    public function getTimeCreate() {
        return $this->timeCreated;
    }

    public function getDeliveryStatus() {
        return $this->deliveryStatus;
    }

    public function getError() {
        return $this->error;
    }

    public function getSmsActiveStatus() {
        return $this->smsActiveStatus;
    }

    public function getTarget() {
        return $this->target;
    }
}
