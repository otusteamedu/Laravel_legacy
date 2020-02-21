<?php


namespace App\Http\Middleware\SiteAccess;
/**
 * Class CheckResult
 * @package App\Http\Middleware\SiteAccess
 * Хранит результат проверки посредника в переменной $passed
 */

class CheckResult
{
    /**
     * @var bool
     */
    public static $passed = false;
}
