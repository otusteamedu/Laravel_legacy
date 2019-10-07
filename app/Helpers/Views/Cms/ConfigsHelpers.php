<?php
/**
 * Description of ConfigsHelpers.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Helpers\Views\Cms;


trait ConfigsHelpers
{
    public static function translateStatus($status)
    {
        if (isset(config('cms')['general']['status'][$status])) {
            $status = config('cms')['general']['status'][$status];
            return trans("cms.general.status.$status");
        }
        return self::TRANSLATION_NOT_FOUND;
    }

    public static function translateCMSConfig($model, $config, $value, $translateConfig = '', $locale = null)
    {
        if (isset(config('cms')[$model][$config][$value])) {
            $translateConfig = $translateConfig ?: $config;
            $key = config('cms')[$model][$config][$value];

            return trans("cms.$model.$translateConfig.$key", [], $locale);
        }
        return self::TRANSLATION_NOT_FOUND;
    }

    public static function getTranslatedCMSConfigs($model, $config, $translateConfig = '')
    {
        $configs = [];
        if (isset(config('cms')[$model][$config])) {
            $configs = config('cms')[$model][$config];
            if (!empty($translateConfig)) {
                $parts = explode('.', $translateConfig);
                if ($parts > 1) {
                    $translateModel = array_shift($parts);
                    $translateConfig = array_shift($parts);
                } else {
                    $translateModel = $model;
                }
            } else {
                $translateConfig = $config;
                $translateModel = $model;
            }
            foreach ($configs as $key => $values) {
                $configs[$key] = trans("cms.{$translateModel}.{$translateConfig}.{$values}");
            }
        }
        return $configs;
    }
}