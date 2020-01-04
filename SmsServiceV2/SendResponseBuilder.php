<?php

namespace SmsServiceV2;

class SendResponseBuilder {
    private $id;
    private $error;

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setError($error) {
        $this->error = $error;
        return $this;
    }

    public function built() {

        $this->validate();

        if (!empty($this->error)) {
            throw new \RuntimeException(implode(';' , $this->error));
        }
        return SendResponse::build($this);
    }

    private function validate() {
        if (empty($this->id)) {
            $this->error[] = 'Не задан id смс';
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getError() {
        return $this->error;
    }
}
