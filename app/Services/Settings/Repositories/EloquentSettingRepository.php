<?php

namespace App\Services\Settings\Repositories;

use App\DTOs\SettingDTO;
use App\Models\Setting;

/**
 * Class EloquentSettingRepository
 * @package App\Services\Settings\Repositories
 */
class EloquentSettingRepository implements SettingRepositoryInterface
{
    /**
     * @param SettingDTO $DTO
     * @return Setting
     */
    public function store(SettingDTO $DTO): Setting
    {
        $setting = $this->getByKey($DTO->toArray()[SettingDTO::KEY]) ?? new Setting();
        $setting->fill($DTO->toArray());
        $setting->save();

        return $setting;
    }

    /**
     * @param SettingDTO $DTO
     * @param Setting $setting
     * @return Setting
     */
    public function update(SettingDTO $DTO, Setting $setting): Setting
    {
        $setting->fill($DTO->toArray());
        $setting->save();

        return $setting;
    }

    /**
     * @param string $key
     * @return Setting|null
     */
    public function getByKey(string $key): ?Setting
    {
        return Setting::where('key', $key)->first();
    }
}
