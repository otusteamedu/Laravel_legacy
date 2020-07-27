<?php

namespace App\Models;

use App\Services\Settings\SettingService;
use Illuminate\Support\Collection;

class Setting extends CacheModel
{
    protected $fillable = [
        'key',
        'value',
        'serialized',
    ];

    /**
     * @var string
     */
    protected $rememberCacheTag = SettingService::CACHE_TAG;

    public static function getSettings(string $key = null): Collection
    {
        $settings = $key ? static::where('key', $key)->first() : static::get();
        $collect = collect();

        foreach ($settings as $setting) {
            $collect->put($setting->key, $setting->value);
        }

        return $collect;
    }
}
