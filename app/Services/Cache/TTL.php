<?php


namespace App\Services\Cache;


class TTL
{
    const LATEST_TTL_HOUR = 3600;
    const CATEGORIES_TTL = self::LATEST_TTL_HOUR * 120;
    const IMAGES_TTL = self::LATEST_TTL_HOUR * 120;
}
