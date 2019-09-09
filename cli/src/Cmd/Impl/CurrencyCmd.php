<?php

namespace Solyaris\Cmd\Impl;

use DOMDocument;
use Exception;
use Solyaris\App\Config;
use Solyaris\App\Options;
use Solyaris\App\Option;
use Solyaris\Cmd\Cmd;
use Solyaris\Cmd\CmdArgsException;
use Solyaris\Cmd\CmdExecException;
use Solyaris\Net\Socket;

use function strtoupper;

class CurrencyCmd extends Cmd
{
    const RESOURCE_HOST = "www.cbr.ru";
    const RESOURCE_URL_FORMAT = "/scripts/XML_daily.asp?date_req=%02d/%02d/%04d";

    private $currencies = null;
    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return new Options([
            new Option('currency', Option::T_STRING, 'код валюты', 'USD', "USR, EUR..."),
            new Option('value', Option::T_NUMBER, 'сумма', 0, "целое число")
        ]);
    }

    /**
     * @param Config $config
     * @throws CmdArgsException
     */
    public function validate(Config $config)  {
        $currency = strtoupper($config->get('currency'));
        $value = (int) $config->get('value');
        if(!array_key_exists($currency, $this->getCurrencies()))
            throw new CmdArgsException($currency . " - неизвестная валюта");
        if($value <= 0)
            throw new CmdArgsException("сумма должна быть неотрицательной");
    }
    /**
     * @return string
     * @throws CmdExecException
     * @throws CmdArgsException
     */
    public function execute(): string
    {
        $config = $this->getExecConfig();
        $currency = strtoupper($config->get('currency'));
        $value = (int) $config->get('value');
        $valute = $this->getCurrencies()[$currency];
        $valute["Value"] = (float) str_replace(",", ".", $valute["Value"]);
         
        return number_format($value * $valute["Value"] / (int) $valute["Nominal"], 2, ",", ".");
    }
    /**
     * @return string
     */
    public function getName() : string {
        return "Конвертер валют";
    }

    private function loadCurrInfo() {
        $in = "GET ".sprintf(self::RESOURCE_URL_FORMAT, (int) date("d"), (int) date("m"), (int) date("Y"))." HTTP/1.1\r\n";
        $in .= "Host: " . self::RESOURCE_HOST . "\r\n";
        $in .= "Connection: Close\r\n\r\n";

        try {
            $socket = Socket::createClient(self::RESOURCE_HOST, AF_INET, 80);
            $socket->Send($in);
            $out = $socket->Receive();
        }
        catch(Exception $e) {
        }
        finally {
            $socket->Close();
        }

        $pos = strpos($out, "\r\n\r\n");
        $xml = substr($out, $pos + 4);

        $doc = DOMDocument::loadXML($xml);
        $list = $doc->getElementsByTagName ("Valute");

        $result = [];
        foreach($list as $valute) {
            $key = '';
            $item = [];
            foreach($valute->childNodes as $node)
                if($node->nodeType == XML_ELEMENT_NODE) {
                    $tag = $node->tagName;
                    $value = $node->nodeValue;
                    if($tag == 'CharCode')
                        $key = $value;
                    $item[$tag] = $value;
                }

            $result[$key] = $item;
        }

        return $result;
    }

    private function getCurrencies(): array {
        if(is_null($this->currencies))
            $this->currencies = $this->loadCurrInfo();
        return $this->currencies;
    }
}