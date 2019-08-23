<?php

namespace App\Common\Handler;

/**
 * Адаптер для XMLAbstractParser -> XMLParser
 * Class XMLParserAdapter
 * @package App\Common\Handler
 */
class XMLParserAdapter extends XMLAbstractParser {
    /**
     * @var XmlParser
     */
    private $xmlParser;

    /**
     * XMLParserAdapter constructor.
     * @param string $path
     * @param XmlParser $xmlLoader
     */
    public function __construct(string $path, XmlParser $xmlParser) {
        parent::__construct($path);
        $this->xmlParser = $xmlParser;
    }

    protected function onChain(ParserData $tagData, $nPhase, string $path) {
        if(XMLAbstractParser::PHASE_NEW == $nPhase) {
            $this->xmlParser->startChain($path, $tagData);
        }
        else if(XMLAbstractParser::PHASE_POST == $nPhase) {
            $this->xmlParser->closeChain($path);
        }
    }

    protected function onChainRule(ParserData $tagData, $nPhase, $path) {
        $this->xmlParser->callChainRule($path, $tagData, $nPhase);
    }

    /**
     * Прерывание процесса парсинга возможно всегда, когда анализатор не находится внутри
     * анализа неделимого объекта
     * @return bool
     */
    public function isMustInterrupt() : bool {
        return $this->xmlParser->getCurrentChain() == null;
    }
}