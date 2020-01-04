<?php

namespace SmsServiceV2;

class SendResponse {
    private $id;
    private $error;

    public function __construct(SendResponseBuilder $builder) {
        $this->id = $builder->getId();
        $this->error = $builder->getError();
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
