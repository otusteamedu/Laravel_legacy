<?php


namespace App\Helpers\Views;


use App\Base\Repository\TListItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class AdminHelpers
{
    const FORMAT_SITE_DATE = "d.m.Y";
    const FORMAT_SITE_TIME = "H:i";
    const FORMAT_SITE_DATE_TIME = "d.m.Y H:i";
    const PHONE_FORMAT = "/\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}/is";

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

    // телефон должен содержать 10 цЫферег
    public static function normalizePhone(string $value): ?string {
        if(preg_match(self::PHONE_FORMAT, $value))
            return $value;
        $value = preg_replace("/[^0-9]/", "", $value);
        if(strlen($value) == 11) {
            $first = substr($value, 0, 1);
            if(($first == "7") || ($first == "8"))
                $value = substr($value, 1);
        }
        if(strlen($value) != 10)
            return null;

        preg_match("/([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", $value, $ms);
        return sprintf("(%s) %s-%s-%s", $ms[1], $ms[2], $ms[3], $ms[4]);
    }

    public static function generatePassword(int $length = 6): string
    {
        $chars = '0123456789';
        $n = strlen($chars) - 1;
        $string = '';
        for ($i = 0; $i < $length; $i++)
            $string .= $chars[mt_rand(0, $n)];
        return $string;
    }
}

