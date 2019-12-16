<?php
/**
 * Хелпер для создания обьекта SimpleXMLElement из массива любой вложенности
 *
 */

namespace App\Helpers;

use SimpleXMLElement;

class XmlResponseHelper
{
    /**
     * Делает из массива xml. Важно! На первом уровне вложенности у массива должен быть один элемент, ключ которого
     * будет названием главного элемента в xml файле
     *
     * @param $array array
     * @return SimpleXMLElement
     */
    public static function ParseXMLToArray(array $array)
    {
        if(count($array) !== 1) {
            return new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request/>');
        }

        $mainElementName = array_key_first($array);
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><'.$mainElementName.'/>');

        $result = self::convertRecursiveArrayElementsToXML($array[$mainElementName], $xml);

        return $result;
    }

    static private function convertRecursiveArrayElementsToXML($array, SimpleXMLElement $xmlObj){
        foreach($array as $key=>$value){
            $xmlObj->addChild($key);

            if(isset($value['@value'])){
                if(!is_array($value['@value'])){
                    $xmlObj->$key = $value['@value'];
                }
                else {
                    self::convertRecursiveArrayElementsToXML($value['@value'], $xmlObj->$key);
                }
            }
            if (isset($value['@attributes'])) {
                foreach ($value['@attributes'] as $attributeName => $attributeValue){
                    $xmlObj->$key->addAttribute($attributeName, $attributeValue);
                }
            }

        }
        return $xmlObj;
    }
}