<?php

namespace App\Services\Settings\Repositories;

use App\DTOs\SettingDTO;
use App\Models\Setting;

/**
 * Interface SettingRepositoryInterface
 * @package App\Services\Settings\Repositories
 */
interface SettingRepositoryInterface
{
    /**
     * @param SettingDTO $DTO
     * @return Setting
     */
    public function store(SettingDTO $DTO): Setting;

    /**
     * @param SettingDTO $DTO
     * @param Setting $setting
     * @return Setting
     */
    public function update(SettingDTO $DTO, Setting $setting): Setting;

    /**
     * @param string $key
     * @return Setting|null
     */
    public function getByKey(string $key): ?Setting;
}
