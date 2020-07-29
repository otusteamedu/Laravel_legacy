<?php

namespace App\Models;

use App\Services\Settings\SettingService;
use Illuminate\Support\Collection;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property bool $serialized
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSerialized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
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

    /**
     * @param string|null $key
     * @return Collection
     */
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
