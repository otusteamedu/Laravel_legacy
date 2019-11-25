<?php


namespace App\Helpers\Views;


use App\Base\Repository\TListItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class AdminHelpers
{
    const FORMAT_SITE_DATE = "d.m.Y";
    const FORMAT_SITE_DATE_TIME = "d.m.Y H:i";

    public static function forSelect(Collection $list): array {
        $result = [];
        /** @var $item TListItem */
        foreach($list as $item) {
            $result[$item->getListId()] = $item->getListTitle();
        }

        return $result;
    }

    public static function Date_site_db(string $value = null): string {
        /** @var $date Carbon */
        $date = null;
        if(!$value)
            $value = date(self::FORMAT_SITE_DATE);
        try {
            $date = Carbon::createFromFormat(self::FORMAT_SITE_DATE, $value);
        }
        catch (\Exception $e) { }

        return $date ? $date->format("Y-m-d") : '';
    }

    public static function Date_db_site(string $value): string {
        /** @var $date Carbon */
        $date = null;
        try {
            $date = Carbon::createFromFormat("Y-m-d", $value);
        }
        catch (\Exception $e) { }

        return $date ? $date->format(self::FORMAT_SITE_DATE) : '';
    }

    public static function Datetime_site_db(string $value = null): string {
        /** @var $date Carbon */
        $date = null;
        if(!$value)
            $value = date(self::FORMAT_SITE_DATE_TIME);
        try {
            $date = Carbon::createFromFormat(self::FORMAT_SITE_DATE_TIME, $value);
        }
        catch (\Exception $e) { }

        return $date ? $date->format("Y-m-d H:i:s") : '';
    }

    public static function Datetime_db_site(string $value): string {
        /** @var $date Carbon */
        $date = null;
        try {
            $date = Carbon::createFromFormat("Y-m-d H:i:s", $value);
        }
        catch (\Exception $e) { }

        return $date ? $date->format(self::FORMAT_SITE_DATE_TIME) : '';
    }

    public static function DbTimeStamps($bCreated = false): array {
        $result = [];
        if($bCreated)
            $result['created_at'] = \Carbon\Carbon::now();
        $result['updated_at'] = \Carbon\Carbon::now();

        return $result;
    }

    public static function isTrue(string $value): bool {
        $value = strtolower($value);
        return ($value == '1') || ($value == 'y') || ($value == 'yes') || ($value == 'on');
    }
    public static function isFalse(string $value): bool {
        return !self::isTrue($value);
    }
}

