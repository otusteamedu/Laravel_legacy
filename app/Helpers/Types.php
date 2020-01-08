<?php


namespace App\Helpers;


class Types {
    public static function IsIntArray(&$testArray): bool {
        if(!is_array($testArray))
            return false;
        $result = $testArray;
        $testArray = [];
        foreach ($result as $intValue) {
            $intValue = (int) $intValue;
            if($intValue > 0)
                $testArray[] = $intValue;
        }

        return (count($testArray) > 0);
    }

    public static function IsInt(&$testValue): bool {
        $testValue = (int) $testValue;
        return ($testValue > 0);
    }
}
