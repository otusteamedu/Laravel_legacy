<?php


namespace App\Services;


class PageHelper
{
    const TITLE_POSTFIX = "Instagraphia.kz";

    public static function generateTitle($title)
    {
        return $title . " | " . self::TITLE_POSTFIX;
    }
}
