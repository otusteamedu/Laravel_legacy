<?php

namespace App\Common\Handler;
use App\Common\Config\Config;

abstract class XmlParser extends Handler
{
    private $parser;

    public function __construct(Config $paramValues) {
        parent::__construct($paramValues);

        $this->parser = new XMLParserAdapter($this->getParam('filePath'));
    }
}