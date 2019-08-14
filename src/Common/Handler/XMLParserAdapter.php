<?php

namespace App\Common\Handler;

class XMLParserAdapter extends XMLAbstractParser {
    private $xmlLoader;

    public function __construct(XmlParser $xmlLoader) {
        parent::__construct();
        $this->xmlLoader = $xmlLoader;
    }

    protected function onChain(array $tagData, $nPhase, $path) {
        if(self::PHASE_NEW == $nPhase) {
            
        }
        else if(self::PHASE_POST == $nPhase) {

        }
    }

    protected function onChainItem(array $tagData, $nPhase, $path) {
        if(self::PHASE_NEW == $nPhase) {

        }
        else if(self::PHASE_POST == $nPhase) {

        }
    }    
}