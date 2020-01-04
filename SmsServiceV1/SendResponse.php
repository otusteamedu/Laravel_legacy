<?php

namespace SmsServiceV1;

class SendResponse {
    private $id;
    private $error;

    public function __construct($id, $error) {
        $this->id = $id;
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getError() {
        return $this->error;
    }
}
